<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitDeliverableRequest;
use App\Models\Project;
use App\Models\ProjectDeliverable;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DeliverableController extends Controller
{
    use ApiResponse;

    /*
    |--------------------------------------------------------------------------
    | LIST — GET /v1/projects/{project}/deliverables
    |--------------------------------------------------------------------------
    */
    public function index(Request $request, Project $project)
    {
        if ($project->user_id !== $request->user()->id) {
            return $this->error('Project not found', 404);
        }

        $deliverables = $project->deliverables()
            ->latest()
            ->paginate($request->integer('per_page', 15));

        return $this->success($deliverables, 'Deliverables retrieved successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE — POST /v1/projects/{project}/deliverables
    |--------------------------------------------------------------------------
    */
    public function store(SubmitDeliverableRequest $request, Project $project)
    {
        if ($project->user_id !== $request->user()->id) {
            return $this->error('Project not found', 404);
        }

        if (!$project->isApproved()) {
            return $this->error('Deliverables can only be submitted for approved projects', 422);
        }

        $file = $request->file('file');
        $path = $file->store('projects/' . $project->id . '/deliverables', 'public');

        $deliverable = $project->deliverables()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'file_name'   => $file->getClientOriginalName(),
            'file_path'   => $path,
            'file_type'   => $file->getClientMimeType(),
            'file_size'   => $file->getSize(),
            'status'      => ProjectDeliverable::STATUS_SUBMITTED,
        ]);

        \App\Models\ActivityLog::create([
            'user_id'    => $request->user()->id,
            'action'     => 'DELIVERABLE_SUBMITTED',
            'details'    => "Submitted deliverable '{$deliverable->title}' for project '{$project->title}'",
            'ip_address' => $request->ip(),
        ]);

        return $this->success($deliverable, 'Deliverable submitted successfully', 201);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW — GET /v1/projects/{project}/deliverables/{deliverable}
    |--------------------------------------------------------------------------
    */
    public function show(Request $request, Project $project, ProjectDeliverable $deliverable)
    {
        if ($project->user_id !== $request->user()->id) {
            return $this->error('Project not found', 404);
        }

        if ($deliverable->project_id !== $project->id) {
            return $this->error('Deliverable not found', 404);
        }

        return $this->success($deliverable, 'Deliverable retrieved successfully');
    }
}
