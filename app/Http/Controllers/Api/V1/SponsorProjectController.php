<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SponsorProjectController extends Controller
{
    /**
     * Display a listing of approved projects available for funding.
     */
    public function index()
    {
        $projects = \App\Models\Project::where('status', 'approved')->with('creator')->get();
        return response()->json(['projects' => $projects]);
    }

    /**
     * Display specific project details. If the sponsor funded it, include deliverables.
     */
    public function show(Request $request, $projectId)
    {
        $project = \App\Models\Project::with(['creator', 'milestones'])->findOrFail($projectId);
        
        $hasFunded = \App\Models\SponsorCommitment::where('project_id', $projectId)
                                      ->where('user_id', $request->user()->id)
                                      ->exists();
        
        if ($hasFunded) {
            $project->load('deliverables');
        }

        return response()->json([
            'project' => $project,
            'has_funded' => $hasFunded
        ]);
    }

    /**
     * Process a funding commitment.
     */
    public function fund(Request $request, $projectId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $project = \App\Models\Project::where('status', 'approved')->findOrFail($projectId);

        $commitment = \App\Models\SponsorCommitment::create([
            'user_id' => $request->user()->id,
            'project_id' => $project->id,
            'amount' => $request->amount,
            'status' => 'completed'
        ]);

        \App\Models\ActivityLog::create([
            'user_id'    => $request->user()->id,
            'action'     => 'PROJECT_FUNDED',
            'details'    => "Sponsor pledged {$request->amount} to project '{$project->title}'",
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'message' => 'Successfully pledged funding for this project.',
            'commitment' => $commitment
        ], 201);
    }

    /**
     * Fetch a list of projects the sponsor has funded.
     */
    public function myFundedProjects(Request $request)
    {
        $commitments = \App\Models\SponsorCommitment::with('project.creator')
                                        ->where('user_id', $request->user()->id)
                                        ->get();

        return response()->json(['commitments' => $commitments]);
    }

    /**
     * Fetch stats for the sponsor dashboard.
     */
    public function dashboardStats(Request $request)
    {
        $userId = $request->user()->id;
        
        $newProjectsCount = \App\Models\Project::where('status', 'approved')->count();
        $savedProjectsCount = \App\Models\SponsorProjectInteraction::where('user_id', $userId)
                                ->where('interaction_type', 'save')->count();
        $interestedProjectsCount = \App\Models\SponsorProjectInteraction::where('user_id', $userId)
                                ->where('interaction_type', 'like')->count();

        return response()->json([
            'new_projects' => $newProjectsCount,
            'saved_projects' => $savedProjectsCount,
            'interested_projects' => $interestedProjectsCount
        ]);
    }

    /**
     * Handle user interactions with a project (like, dislike, save, viewed).
     */
    public function interact(Request $request, $projectId)
    {
        $request->validate([
            'type' => 'required|in:save,like,dislike,viewed'
        ]);

        $project = \App\Models\Project::findOrFail($projectId);

        // Update or create the interaction
        $interaction = \App\Models\SponsorProjectInteraction::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'project_id' => $project->id,
                'interaction_type' => $request->type
            ],
            []
        );

        \App\Models\ActivityLog::create([
            'user_id'    => $request->user()->id,
            'action'     => 'PROJECT_INTERACTED',
            'details'    => "Sponsor interacted with project '{$project->title}' (type: {$request->type})",
            'ip_address' => $request->ip(),
        ]);

        if ($request->type === 'like') {
            \App\Models\Message::create([
                'user_id' => $request->user()->id,
                'recipient_id' => $project->user_id,
                'message' => 'I am interested in the project "' . $project->title . '".'
            ]);
        }

        return response()->json([
            'message' => 'Interaction recorded successfully',
            'interaction' => $interaction
        ]);
    }

    /**
     * Fetch projects the sponsor has previously interacted with (Project Review).
     */
    public function reviewedProjects(Request $request)
    {
        $userId = $request->user()->id;

        $interactions = \App\Models\SponsorProjectInteraction::with('project.creator')
                            ->where('user_id', $userId)
                            ->get();

        // Extract unique projects from interactions
        $projects = $interactions->map(function($interaction) {
            $project = $interaction->project;
            $project->interaction_type = $interaction->interaction_type; // inject the interaction context
            return $project;
        })->unique('id')->values();

        return response()->json(['projects' => $projects]);
    }
}
