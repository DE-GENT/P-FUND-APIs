<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ProjectDocument;
use App\Models\ProjectDeliverable;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    use ApiResponse;

    /*
    |--------------------------------------------------------------------------
    | STREAM / DOWNLOAD — GET /v1/documents/{document}/download
    | Streams a project proposal document to the browser (admin + vetter)
    |--------------------------------------------------------------------------
    */
    public function download(Request $request, ProjectDocument $document)
    {
        $user = $request->user();

        // Only admin, sponsor, vetters, or the project owner (creator) can download documents
        $isOwner = $user->role === 'creator' && $document->project && $document->project->user_id === $user->id;
        if (!in_array(strtolower($user->role ?? ''), ['admin', 'sponsor']) 
            && !str_starts_with(strtolower($user->role ?? ''), 'vetter')
            && !$isOwner
        ) {
            return $this->error('Access denied.', 403);
        }

        $disk = Storage::disk('public');

        if (!$disk->exists($document->file_path)) {
            return $this->error('File not found on server.', 404);
        }

        return response()->streamDownload(function () use ($disk, $document) {
            echo $disk->get($document->file_path);
        }, $document->file_name, [
            'Content-Type'        => $document->file_type ?? 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="' . $document->file_name . '"',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STREAM DELIVERABLE — GET /v1/deliverables/{deliverable}/download
    | Streams a deliverable file (admin + vetter)
    |--------------------------------------------------------------------------
    */
    public function downloadDeliverable(Request $request, ProjectDeliverable $deliverable)
    {
        $user = $request->user();

        // Only admin, sponsor, vetters, or the project owner (creator) can download deliverables
        $isOwner = $user->role === 'creator' && $deliverable->project && $deliverable->project->user_id === $user->id;
        if (!in_array(strtolower($user->role ?? ''), ['admin', 'sponsor']) 
            && !str_starts_with(strtolower($user->role ?? ''), 'vetter')
            && !$isOwner
        ) {
            return $this->error('Access denied.', 403);
        }

        $disk = Storage::disk('public');

        if (!$deliverable->file_path || !$disk->exists($deliverable->file_path)) {
            return $this->error('No file attached to this deliverable.', 404);
        }

        return response()->streamDownload(function () use ($disk, $deliverable) {
            echo $disk->get($deliverable->file_path);
        }, $deliverable->file_name ?? 'deliverable', [
            'Content-Type'        => $deliverable->file_type ?? 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="' . ($deliverable->file_name ?? 'deliverable') . '"',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LIST DOCUMENTS FOR A PROJECT — GET /v1/projects/{project}/all-documents
    | Returns all documents + deliverables for a project (admin + vetter)
    |--------------------------------------------------------------------------
    */
    public function projectFiles(Request $request, \App\Models\Project $project)
    {
        $user = $request->user();

        // Only admin, sponsor, vetters, or the project owner (creator) can list project files
        $isOwner = $user->role === 'creator' && $project->user_id === $user->id;
        if (!in_array(strtolower($user->role ?? ''), ['admin', 'sponsor']) 
            && !str_starts_with(strtolower($user->role ?? ''), 'vetter')
            && !$isOwner
        ) {
            return $this->error('Access denied.', 403);
        }

        $documents    = $project->documents()->get()->map(fn($d) => [
            'id'          => $d->id,
            'type'        => 'proposal_document',
            'name'        => $d->file_name,
            'file_type'   => $d->file_type,
            'size'        => $d->file_size,
            'uploaded_at' => $d->created_at,
            'download_url'=> url("/api/v1/documents/{$d->id}/download"),
        ]);

        $deliverables = $project->deliverables()->get()->map(fn($d) => [
            'id'          => $d->id,
            'type'        => 'deliverable',
            'name'        => $d->file_name ?? $d->title,
            'title'       => $d->title,
            'description' => $d->description,
            'file_type'   => $d->file_type,
            'size'        => $d->file_size,
            'status'      => $d->status,
            'uploaded_at' => $d->created_at,
            'download_url'=> $d->file_path ? url("/api/v1/deliverables/{$d->id}/download") : null,
        ]);

        return $this->success([
            'project'      => [
                'id'    => $project->id,
                'title' => $project->title,
            ],
            'documents'    => $documents,
            'deliverables' => $deliverables,
            'total'        => $documents->count() + $deliverables->count(),
        ], 'Project files retrieved successfully');
    }
}
