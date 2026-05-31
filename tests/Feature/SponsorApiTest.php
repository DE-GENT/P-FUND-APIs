<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use App\Models\SponsorCommitment;
use App\Models\SponsorProjectInteraction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SponsorApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_sponsor_endpoints()
    {
        // 1. Create a Sponsor and a Creator
        $sponsor = User::factory()->create(['role' => 'sponsor', 'email' => 'sponsor@example.com']);
        $creator = User::factory()->create(['role' => 'creator', 'email' => 'creator@example.com']);

        // 2. Create Projects (one approved, one draft) using create() directly
        $approvedProject = Project::create([
            'user_id' => $creator->id,
            'title' => 'Approved Solar Project',
            'description' => 'Approved project description',
            'category' => 'environment',
            'status' => 'approved',
            'budget_amount' => 100000,
            'budget_currency' => 'USD',
        ]);

        $draftProject = Project::create([
            'user_id' => $creator->id,
            'title' => 'Draft Wind Project',
            'description' => 'Draft project description',
            'category' => 'environment',
            'status' => 'draft',
            'budget_amount' => 50000,
            'budget_currency' => 'USD',
        ]);

        // 3. Test list approved projects (index)
        $response = $this->actingAs($sponsor)
            ->getJson('/api/v1/sponsor/projects');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'projects')
            ->assertJsonPath('projects.0.id', $approvedProject->id);

        // 4. Test view project details (show)
        $response = $this->actingAs($sponsor)
            ->getJson("/api/v1/sponsor/projects/{$approvedProject->id}");

        $response->assertStatus(200)
            ->assertJsonPath('project.id', $approvedProject->id)
            ->assertJsonPath('has_funded', false);

        // 5. Test fund project (fund)
        $response = $this->actingAs($sponsor)
            ->postJson("/api/v1/sponsor/projects/{$approvedProject->id}/fund", [
                'amount' => 5000,
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('commitment.amount', 5000);

        // 6. Test view project details again (should now include deliverables / has_funded = true)
        $response = $this->actingAs($sponsor)
            ->getJson("/api/v1/sponsor/projects/{$approvedProject->id}");

        $response->assertStatus(200)
            ->assertJsonPath('has_funded', true);

        // 7. Test my funded projects
        $response = $this->actingAs($sponsor)
            ->getJson('/api/v1/sponsor/my-funded-projects');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'commitments')
            ->assertJsonPath('commitments.0.project_id', $approvedProject->id);

        // 8. Test interact (like)
        $response = $this->actingAs($sponsor)
            ->postJson("/api/v1/sponsor/projects/{$approvedProject->id}/interact", [
                'type' => 'like',
            ]);

        $response->assertStatus(200)
            ->assertJsonPath('interaction.interaction_type', 'like');

        // 9. Test interact (save)
        $response = $this->actingAs($sponsor)
            ->postJson("/api/v1/sponsor/projects/{$approvedProject->id}/interact", [
                'type' => 'save',
            ]);

        $response->assertStatus(200)
            ->assertJsonPath('interaction.interaction_type', 'save');

        // 10. Test dashboard stats
        $response = $this->actingAs($sponsor)
            ->getJson('/api/v1/sponsor/dashboard/stats');

        $response->assertStatus(200)
            ->assertJsonPath('new_projects', 1)
            ->assertJsonPath('saved_projects', 1);

        // 11. Test reviewed projects
        $response = $this->actingAs($sponsor)
            ->getJson('/api/v1/sponsor/projects/reviewed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'projects')
            ->assertJsonPath('projects.0.id', $approvedProject->id);
    }
}
