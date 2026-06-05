<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\ProjectDocument;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    use ApiResponse;

    /*
    |--------------------------------------------------------------------------
    | LIST — GET /v1/projects
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $query = Project::forUser($request->user()->id)
            ->with('documents')
            ->latest();

        if ($request->has('status')) {
            $query->byStatus($request->status);
        }

        $projects = $query->paginate($request->integer('per_page', 15));

        return $this->success($projects, 'Projects retrieved successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE — POST /v1/projects
    |--------------------------------------------------------------------------
    */
    public function store(StoreProjectRequest $request)
    {
        DB::beginTransaction();
        try {
            $project = $request->user()->projects()->create(
                $request->only(['title', 'description', 'category', 'budget_amount', 'budget_currency'])
            );

            // Handle document uploads
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    $path = $file->store('projects/' . $project->id . '/documents', 'public');

                    $project->documents()->create([
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_type' => $file->getClientMimeType(),
                        'file_size' => $file->getSize(),
                    ]);
                }
            }

            \App\Models\ActivityLog::create([
                'user_id'    => $request->user()->id,
                'action'     => 'PROJECT_CREATED',
                'details'    => "Created project draft '{$project->title}'",
                'ip_address' => $request->ip(),
            ]);

            DB::commit();

            return $this->success(
                $project->fresh()->load('documents'),
                'Project created successfully',
                201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Project creation failed: ' . $e->getMessage());
            return $this->error('Failed to create project. Please try again.', 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW — GET /v1/projects/{project}
    |--------------------------------------------------------------------------
    */
    public function show(Request $request, Project $project)
    {
        // Ensure the creator can only view their own projects
        if ($project->user_id !== $request->user()->id) {
            return $this->error('Project not found', 404);
        }

        return $this->success(
            $project->load(['documents', 'deliverables']),
            'Project retrieved successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE — PUT /v1/projects/{project}
    |--------------------------------------------------------------------------
    */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        if ($project->user_id !== $request->user()->id) {
            return $this->error('Project not found', 404);
        }

        if (!$project->isDraft() && $project->status !== Project::STATUS_REJECTED && $project->status !== Project::STATUS_NEEDS_UPDATE) {
            return $this->error('Only draft, rejected, or update-required projects can be updated', 422);
        }

        $project->update($request->validated());

        if ($project->status === Project::STATUS_REJECTED) {
            $project->update([
                'status' => Project::STATUS_DRAFT
            ]);
        }

        // Notify all Admins and Vetters about the update
        try {
            $recipients = \App\Models\User::where('role', 'admin')
                ->orWhere('role', 'like', 'vetter%')
                ->get();

            foreach ($recipients as $recipient) {
                \App\Models\Notification::create([
                    'user_id' => $recipient->id,
                    'type'    => 'project_updated',
                    'title'   => '📝 Project Updated',
                    'body'    => "The project \"{$project->title}\" has been updated by its creator {$request->user()->name}.",
                    'link'    => $recipient->role === 'admin' 
                        ? '/dashboard/admin/project-tracking' 
                        : '/dashboard/vetter',
                ]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to create update notifications: ' . $e->getMessage());
        }

        return $this->success(
            $project->fresh()->load('documents'),
            'Project updated successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE — DELETE /v1/projects/{project}
    |--------------------------------------------------------------------------
    */
    public function destroy(Request $request, Project $project)
    {
        if ($project->user_id !== $request->user()->id) {
            return $this->error('Project not found', 404);
        }

        if (!$project->isDraft()) {
            return $this->error('Only draft projects can be deleted', 422);
        }

        // Documents are cascade-deleted, but we also need to remove physical files
        foreach ($project->documents as $document) {
            Storage::disk('public')->delete($document->file_path);
        }

        \App\Models\ActivityLog::create([
            'user_id'    => $request->user()->id,
            'action'     => 'PROJECT_DELETED',
            'details'    => "Deleted project draft '{$project->title}'",
            'ip_address' => $request->ip(),
        ]);

        $project->delete();

        return $this->success(null, 'Project deleted successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | SUBMIT — POST /v1/projects/{project}/submit
    |--------------------------------------------------------------------------
    */
    public function submit(Request $request, Project $project)
    {
        if ($project->user_id !== $request->user()->id) {
            return $this->error('Project not found', 404);
        }

        if (!$project->isDraft() && $project->status !== Project::STATUS_NEEDS_UPDATE) {
            return $this->error('Only draft or update-required projects can be submitted', 422);
        }

        $isResubmission = ($project->status === Project::STATUS_NEEDS_UPDATE);
        $newStatus = $isResubmission ? 'vetting' : Project::STATUS_SUBMITTED;

        $project->update([
            'status'       => $newStatus,
            'submitted_at' => now(),
        ]);

        // Log the activity
        \App\Models\ActivityLog::create([
            'user_id'    => $request->user()->id,
            'action'     => 'PROJECT_SUBMITTED',
            'details'    => ($isResubmission ? "Resubmitted" : "Submitted") . " project '{$project->title}' (status: {$newStatus})",
            'ip_address' => $request->ip()
        ]);

        // Create in-app notification for the creator
        if ($project->user_id) {
            \App\Models\Notification::create([
                'user_id' => $project->user_id,
                'type'    => $isResubmission ? 'project_resubmitted' : 'project_submitted',
                'title'   => $isResubmission ? '🔄 Project Resubmitted' : '🚀 Project Submitted',
                'body'    => $isResubmission 
                    ? "Your project \"{$project->title}\" was successfully resubmitted and is back in the vetting queue."
                    : "Your project \"{$project->title}\" was successfully submitted and is now pending review.",
                'link'    => '/dashboard/user',
            ]);
        }

        // Notify all Admins and Vetters about the submission/resubmission
        try {
            $recipients = \App\Models\User::where('role', 'admin')
                ->orWhere('role', 'like', 'vetter%')
                ->get();

            foreach ($recipients as $recipient) {
                \App\Models\Notification::create([
                    'user_id' => $recipient->id,
                    'type'    => $isResubmission ? 'project_resubmitted' : 'project_submitted',
                    'title'   => $isResubmission ? '🔄 Project Resubmitted' : '🚀 Project Submitted',
                    'body'    => $isResubmission 
                        ? "The project \"{$project->title}\" was resubmitted by {$request->user()->name} and is back in the vetting queue."
                        : "A new project \"{$project->title}\" was submitted by {$request->user()->name} and is pending review.",
                    'link'    => $recipient->role === 'admin' 
                        ? ($isResubmission ? '/dashboard/admin/project-tracking' : '/dashboard/admin/project-review')
                        : '/dashboard/vetter',
                ]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to create staff notifications on submit: ' . $e->getMessage());
        }

        // Send email to the creator
        try {
            if ($project->user) {
                \Illuminate\Support\Facades\Mail::to($project->user->email)->send(
                    new \App\Mail\ProjectStatusUpdatedMail($project)
                );
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send project submission email: ' . $e->getMessage());
        }

        return $this->success(
            $project->fresh()->load('documents'),
            $isResubmission 
                ? 'Project resubmitted successfully and is back in the vetting queue'
                : 'Project submitted successfully and is now pending review'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD DOCUMENTS — POST /v1/projects/{project}/documents
    |--------------------------------------------------------------------------
    */
    public function uploadDocuments(Request $request, Project $project)
    {
        if ($project->user_id !== $request->user()->id) {
            return $this->error('Project not found', 404);
        }

        if (!$project->isDraft() && $project->status !== Project::STATUS_NEEDS_UPDATE) {
            return $this->error('Documents can only be added to draft or update-required projects', 422);
        }

        $request->validate([
            'documents'   => ['required', 'array', 'min:1', 'max:5'],
            'documents.*' => ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png,xls,xlsx,ppt,pptx,mp4', 'max:51200'],
        ]);

        // Check total document count
        $currentCount = $project->documents()->count();
        $newCount     = count($request->file('documents'));

        if ($currentCount + $newCount > 5) {
            return $this->error(
                "A project can have at most 5 documents. You already have {$currentCount}.",
                422
            );
        }

        $uploaded = [];
        foreach ($request->file('documents') as $file) {
            $path = $file->store('projects/' . $project->id . '/documents', 'public');

            $uploaded[] = $project->documents()->create([
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }

        return $this->success($uploaded, 'Documents uploaded successfully', 201);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE DOCUMENT — DELETE /v1/projects/{project}/documents/{document}
    |--------------------------------------------------------------------------
    */
    public function deleteDocument(Request $request, Project $project, ProjectDocument $document)
    {
        if ($project->user_id !== $request->user()->id) {
            return $this->error('Project not found', 404);
        }

        if (!$project->isDraft() && $project->status !== Project::STATUS_NEEDS_UPDATE) {
            return $this->error('Documents can only be removed from draft or update-required projects', 422);
        }

        if ($document->project_id !== $project->id) {
            return $this->error('Document not found', 404);
        }

        // Physical file is deleted via model's booted() listener
        $document->delete();

        return $this->success(null, 'Document deleted successfully');
    }
}
