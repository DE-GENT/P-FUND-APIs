<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ProjectDeliverable;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class VetterDeliverableController extends Controller
{
    use ApiResponse;

    /*
    |--------------------------------------------------------------------------
    | LIST — GET /v1/vetter/deliverables
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $query = ProjectDeliverable::with(['project:id,title,user_id', 'project.user:id,name,email'])
            ->latest();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            // Default: show submitted deliverables awaiting review
            $query->where('status', ProjectDeliverable::STATUS_SUBMITTED);
        }

        $deliverables = $query->paginate($request->integer('per_page', 15));

        return $this->success($deliverables, 'Deliverables retrieved successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW — GET /v1/vetter/deliverables/{deliverable}
    |--------------------------------------------------------------------------
    */
    public function show(ProjectDeliverable $deliverable)
    {
        return $this->success(
            $deliverable->load(['project:id,title,description,user_id', 'project.user:id,name,email']),
            'Deliverable retrieved successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | REVIEW — POST /v1/vetter/deliverables/{deliverable}/review
    |--------------------------------------------------------------------------
    */
    public function review(Request $request, ProjectDeliverable $deliverable)
    {
        $request->validate([
            'decision' => ['required', 'in:accepted,rejected'],
            'remarks'  => ['nullable', 'string', 'max:2000'],
        ]);

        if (!in_array($deliverable->status, [
            ProjectDeliverable::STATUS_SUBMITTED,
            ProjectDeliverable::STATUS_UNDER_REVIEW,
        ])) {
            return $this->error(
                'Only submitted or under-review deliverables can be reviewed',
                422
            );
        }

        $deliverable->update([
            'status'         => $request->decision,
            'reviewer_id'    => $request->user()->id,
            'review_remarks' => $request->remarks,
            'reviewed_at'    => now(),
        ]);

        \App\Models\ActivityLog::create([
            'user_id'    => $request->user()->id,
            'action'     => 'DELIVERABLE_' . strtoupper($request->decision),
            'details'    => "Reviewed deliverable '{$deliverable->title}' for project '{$deliverable->project->title}' (decision: {$request->decision})",
            'ip_address' => $request->ip(),
        ]);

        // Send notification to project owner about deliverable status
        $project = $deliverable->project;
        if ($project && $project->user_id) {
            $isAccepted = $request->decision === ProjectDeliverable::STATUS_ACCEPTED;
            \App\Models\Notification::create([
                'user_id' => $project->user_id,
                'type'    => $isAccepted ? 'deliverable_accepted' : 'deliverable_rejected',
                'title'   => $isAccepted ? '✅ Deliverable Accepted' : '❌ Deliverable Rejected',
                'body'    => $isAccepted
                    ? "Your deliverable \"{$deliverable->title}\" for project \"{$project->title}\" has been accepted."
                    : "Your deliverable \"{$deliverable->title}\" for project \"{$project->title}\" has been rejected/requires correction. Remarks: \"{$request->remarks}\".",
                'link'    => '/dashboard/user',
            ]);
        }

        $action = $request->decision === ProjectDeliverable::STATUS_ACCEPTED ? 'accepted' : 'rejected';

        return $this->success(
            $deliverable->fresh(),
            "Deliverable has been {$action} successfully"
        );
    }
}
