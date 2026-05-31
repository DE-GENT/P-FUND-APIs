<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    use ApiResponse;

    /*
    |--------------------------------------------------------------------------
    | LIST — GET /v1/admin/projects
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $query = Project::with(['documents', 'user:id,name,email', 'deliverables'])
            ->latest('submitted_at');

        // Allow filtering by status
        if ($request->has('status')) {
            if ($request->status !== 'all') {
                $query->where('status', $request->status);
            }
        } else {
            $query->where('status', Project::STATUS_SUBMITTED);
        }

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $projects = $query->paginate($request->integer('per_page', 15));

        return $this->success($projects, 'Projects retrieved successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW — GET /v1/admin/projects/{project}
    |--------------------------------------------------------------------------
    */
    public function show(Project $project)
    {
        return $this->success(
            $project->load(['documents', 'deliverables', 'milestones', 'user:id,name,email,role']),
            'Project retrieved successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | REVIEW — POST /v1/admin/projects/{project}/review
    |--------------------------------------------------------------------------
    */
    public function review(Request $request, Project $project)
    {
        // Support 'decision' as an alias/input for 'status'
        if ($request->has('decision') && !$request->has('status')) {
            $request->merge(['status' => $request->decision]);
        }

        $request->validate([
            'status' => ['required', 'in:vetting,rejected,approved'],
            'l1_duration' => 'nullable|integer',
            'l2_duration' => 'nullable|integer',
            'l3_duration' => 'nullable|integer',
        ]);

        $project->update([
            'status' => $request->status,
            'reviewed_at' => now(),
        ]);

        if ($request->status === 'vetting') {
            // Generate basic milestones if they don't exist yet
            if ($project->milestones()->count() === 0) {
                \App\Models\Milestone::create(['project_id' => $project->id, 'title' => 'Level 1 Review (Screening)', 'status' => 'pending']);
                \App\Models\Milestone::create(['project_id' => $project->id, 'title' => 'Level 2 Review (Technical)', 'status' => 'pending']);
                \App\Models\Milestone::create(['project_id' => $project->id, 'title' => 'Level 3 Review (Final)', 'status' => 'pending']);
            }
        }

        \App\Models\ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'PROJECT_' . strtoupper($request->status),
            'details' => "Marked project '{$project->title}' as {$request->status}",
            'ip_address' => $request->ip()
        ]);

        // Create in-app notification for project owner
        if ($project->user_id) {
            $titles = [
                'vetting'  => '🔍 Project Accepted for Vetting',
                'rejected' => '❌ Project Rejected',
                'approved' => '✅ Project Approved!',
            ];
            $bodies = [
                'vetting'  => "Your project \"" . $project->title . "\" has been accepted and will now undergo a multi-level vetting review.",
                'rejected' => "Unfortunately, your project \"" . $project->title . "\" has been rejected. Please log in to view admin remarks.",
                'approved' => "Congratulations! Your project \"" . $project->title . "\" has been fully approved for funding deployment.",
            ];
            \App\Models\Notification::create([
                'user_id' => $project->user_id,
                'type'    => 'project_' . $request->status,
                'title'   => $titles[$request->status] ?? 'Project Status Updated',
                'body'    => $bodies[$request->status] ?? 'Your project status has been updated.',
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

        return $this->success(
            $project->fresh()->load('milestones'),
            "Project status updated to {$request->status}"
        );
    }

    public function updateMilestone(Request $request, \App\Models\Milestone $milestone)
    {
        $request->validate(['status' => 'required|in:pending,completed']);
        $milestone->update(['status' => $request->status]);
        
        \App\Models\ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'MILESTONE_UPDATED',
            'details' => "Updated milestone '{$milestone->title}' to {$request->status} for project ID {$milestone->project_id}",
            'ip_address' => $request->ip()
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
            'message' => "Milestone marked as {$request->status}.",
            'milestone' => $milestone->fresh(),
            'all_complete' => $allDone
        ]);
    }
}
