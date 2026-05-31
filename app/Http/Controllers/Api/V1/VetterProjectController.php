<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Milestone;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class VetterProjectController extends Controller
{
    use ApiResponse;

    protected function getMilestoneFilterClosure($role)
    {
        return function ($query) use ($role) {
            if ($role === 'vetter_1') {
                $query->where('title', 'like', 'Level 1%');
            } elseif ($role === 'vetter_2') {
                $query->where('title', 'like', 'Level 2%');
            } elseif ($role === 'vetter_3') {
                $query->where('title', 'like', 'Level 3%');
            }
        };
    }

    /*
    |--------------------------------------------------------------------------
    | LIST — GET /v1/vetter/projects
    | Returns all projects currently in the vetting queue
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $role = $request->user()->role;
        $milestoneFilter = $this->getMilestoneFilterClosure($role);

        $projects = Project::with([
            'user:id,name,email',
            'milestones' => $milestoneFilter,
            'documents'
        ])
        ->where('status', 'vetting')
        ->latest('submitted_at')
        ->get();

        return response()->json($projects);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW — GET /v1/vetter/projects/{project}
    | Returns full project details with milestones and documents
    |--------------------------------------------------------------------------
    */
    public function show(Request $request, Project $project)
    {
        if ($project->status !== 'vetting') {
            return $this->error('This project is not in the vetting queue.', 403);
        }

        $role = $request->user()->role;
        $milestoneFilter = $this->getMilestoneFilterClosure($role);

        return $this->success(
            $project->load([
                'user:id,name,email,phone',
                'milestones' => $milestoneFilter,
                'documents',
                'deliverables'
            ]),
            'Project retrieved successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE MILESTONE — POST /v1/vetter/milestones/{milestone}/complete
    | Marks an individual milestone as complete/pending
    |--------------------------------------------------------------------------
    */
    public function updateMilestone(Request $request, Milestone $milestone)
    {
        $role = $request->user()->role;
        
        // Authorization check
        if ($role === 'vetter_1' && !str_starts_with($milestone->title, 'Level 1')) {
            return response()->json(['message' => 'Unauthorized. You can only update Level 1 milestones.'], 403);
        }
        if ($role === 'vetter_2' && !str_starts_with($milestone->title, 'Level 2')) {
            return response()->json(['message' => 'Unauthorized. You can only update Level 2 milestones.'], 403);
        }
        if ($role === 'vetter_3' && !str_starts_with($milestone->title, 'Level 3')) {
            return response()->json(['message' => 'Unauthorized. You can only update Level 3 milestones.'], 403);
        }

        $request->validate([
            'status'  => 'required|in:pending,completed',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $milestone->update([
            'status'  => $request->status,
        ]);

        // Log activity
        \App\Models\ActivityLog::create([
            'user_id'    => $request->user()->id,
            'action'     => 'MILESTONE_' . strtoupper($request->status),
            'details'    => "Vetter marked milestone '{$milestone->title}' as {$request->status} on project ID {$milestone->project_id}",
            'ip_address' => $request->ip(),
        ]);

        // Check if ALL milestones on this project are now complete
        $project = $milestone->project;
        $allDone = $project->milestones()->where('status', 'pending')->count() === 0;

        if ($allDone) {
            $project->update(['status' => 'approved']);
            // Create activity log for approval
            \App\Models\ActivityLog::create([
                'user_id'    => $request->user()->id,
                'action'     => 'PROJECT_APPROVED',
                'details'    => "Project '{$project->title}' was automatically approved as all vetting milestones were completed.",
                'ip_address' => $request->ip(),
            ]);

            // Notify owner of approval
            if ($project->user_id) {
                \App\Models\Notification::create([
                    'user_id' => $project->user_id,
                    'type'    => 'project_approved',
                    'title'   => '✅ Project Approved!',
                    'body'    => "Congratulations! Your project \"{$project->title}\" has been fully approved for funding deployment as all milestones are complete.",
                    'link'    => '/pages/dashboard/user/dashboard.html',
                ]);
            }

            try {
                if ($project->user) {
                    \Illuminate\Support\Facades\Mail::to($project->user->email)->send(
                        new \App\Mail\ProjectStatusUpdatedMail($project)
                    );
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to send project status email: ' . $e->getMessage());
            }
        } else {
            // Send notification to project owner about milestone update
            if ($project->user_id) {
                \App\Models\Notification::create([
                    'user_id' => $project->user_id,
                    'type'    => 'milestone_updated',
                    'title'   => $request->status === 'completed'
                        ? '✅ Vetting Milestone Completed'
                        : '🔄 Vetting Milestone Reset',
                    'body'    => "Milestone \"{$milestone->title}\" on your project \"{$project->title}\" has been marked as {$request->status}.",
                    'link'    => '/pages/dashboard/user/dashboard.html',
                ]);
            }
        }

        return response()->json([
            'message'      => "Milestone marked as {$request->status}.",
            'milestone'    => $milestone->fresh(),
            'all_complete' => $allDone,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | REQUIRE UPDATE — POST /v1/vetter/projects/{project}/require-update
    | Marks a project as requiring creator update and sets remarks
    |--------------------------------------------------------------------------
    */
    public function requireUpdate(Request $request, Project $project)
    {
        $request->validate([
            'remarks' => 'required|string|max:1000',
        ]);

        if ($project->status !== 'vetting') {
            return response()->json(['message' => 'Only projects in vetting queue can require update.'], 403);
        }

        $project->update([
            'status' => 'needs_update',
            'admin_remarks' => $request->remarks,
        ]);

        // Log activity
        \App\Models\ActivityLog::create([
            'user_id'    => $request->user()->id,
            'action'     => 'PROJECT_REQUIRE_UPDATE',
            'details'    => "Vetter requested project update on '{$project->title}': {$request->remarks}",
            'ip_address' => $request->ip(),
        ]);

        // Send notification to project owner
        if ($project->user_id) {
            \App\Models\Notification::create([
                'user_id' => $project->user_id,
                'type'    => 'project_needs_update',
                'title'   => '⚠️ Project Update Required',
                'body'    => "A reviewer has requested an update for your project \"{$project->title}\". Remarks: \"{$request->remarks}\".",
                'link'    => '/pages/dashboard/user/project-update.html',
            ]);
        }

        try {
            if ($project->user) {
                \Illuminate\Support\Facades\Mail::to($project->user->email)->send(
                    new \App\Mail\ProjectStatusUpdatedMail($project)
                );
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send project update request email: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Project marked as requiring update.',
            'project' => $project->fresh(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | REJECT — POST /v1/vetter/projects/{project}/reject
    | Marks a project as rejected directly by the vetter with remarks
    |--------------------------------------------------------------------------
    */
    public function reject(Request $request, Project $project)
    {
        $request->validate([
            'remarks' => 'required|string|max:1000',
        ]);

        if ($project->status !== 'vetting') {
            return response()->json(['message' => 'Only projects in vetting queue can be rejected.'], 403);
        }

        $project->update([
            'status' => 'rejected',
            'admin_remarks' => $request->remarks,
        ]);

        // Log activity
        \App\Models\ActivityLog::create([
            'user_id'    => $request->user()->id,
            'action'     => 'PROJECT_REJECTED',
            'details'    => "Vetter rejected project '{$project->title}': {$request->remarks}",
            'ip_address' => $request->ip(),
        ]);

        // Send notification to project owner
        if ($project->user_id) {
            \App\Models\Notification::create([
                'user_id' => $project->user_id,
                'type'    => 'project_rejected',
                'title'   => '❌ Project Rejected',
                'body'    => "Your project \"{$project->title}\" has been rejected during review. Remarks: \"{$request->remarks}\".",
                'link'    => '/pages/dashboard/user/project-update.html',
            ]);
        }

        try {
            if ($project->user) {
                \Illuminate\Support\Facades\Mail::to($project->user->email)->send(
                    new \App\Mail\ProjectStatusUpdatedMail($project)
                );
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send project rejection email: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Project marked as rejected.',
            'project' => $project->fresh(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STATS — GET /v1/vetter/stats
    | Quick summary stats for the vetter dashboard
    |--------------------------------------------------------------------------
    */
    public function stats(Request $request)
    {
        $role = $request->user()->role;

        $vettingProjects  = Project::where('status', 'vetting')->count();
        $completedProjects = Project::where('status', 'approved')->count();

        // Count pending/completed milestones filtered by role
        $pendingQuery = Milestone::where('status', 'pending');
        $completedQuery = Milestone::where('status', 'completed');

        if ($role === 'vetter_1') {
            $pendingQuery->where('title', 'like', 'Level 1%');
            $completedQuery->where('title', 'like', 'Level 1%');
        } elseif ($role === 'vetter_2') {
            $pendingQuery->where('title', 'like', 'Level 2%');
            $completedQuery->where('title', 'like', 'Level 2%');
        } elseif ($role === 'vetter_3') {
            $pendingQuery->where('title', 'like', 'Level 3%');
            $completedQuery->where('title', 'like', 'Level 3%');
        }

        $pendingMilestones = $pendingQuery->count();
        $completedMilestones = $completedQuery->count();

        return response()->json([
            'vetting_projects'    => $vettingProjects,
            'completed_projects'  => $completedProjects,
            'pending_milestones'  => $pendingMilestones,
            'completed_milestones'=> $completedMilestones,
        ]);
    }
}
