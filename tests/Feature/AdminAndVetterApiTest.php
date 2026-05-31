<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use App\Models\Milestone;
use App\Models\ProjectDeliverable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminAndVetterApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_and_vetter_and_profile_endpoints()
    {
        Storage::fake('public');

        // Create Admin, Vetter (Level 1), and Creator users
        $admin = User::factory()->create(['role' => 'admin', 'email' => 'admin@example.com']);
        $vetter = User::factory()->create(['role' => 'vetter_1', 'email' => 'vetter1@example.com']);
        $creator = User::factory()->create(['role' => 'creator', 'email' => 'creator@example.com']);

        // Create Project in vetting queue
        $project = Project::create([
            'user_id' => $creator->id,
            'title' => 'Vetting Phase Project',
            'description' => 'Project undergoing vetting',
            'category' => 'technology',
            'status' => 'vetting',
            'budget_amount' => 80000,
            'budget_currency' => 'USD',
        ]);

        // Create Milestones
        $milestone1 = Milestone::create(['project_id' => $project->id, 'title' => 'Level 1 Review (Screening)', 'status' => 'pending']);
        $milestone2 = Milestone::create(['project_id' => $project->id, 'title' => 'Level 2 Review (Technical)', 'status' => 'pending']);

        // --- SECTION 1: ADMIN PROJECT & USER MANAGEMENT ---

        // 1. Admin lists projects
        $response = $this->actingAs($admin)->getJson('/api/v1/admin/projects?status=all');
        $response->assertStatus(200);

        // 2. Admin views specific project
        $response = $this->actingAs($admin)->getJson("/api/v1/admin/projects/{$project->id}");
        $response->assertStatus(200);

        // 3. Admin updates milestone (AdminProjectController@updateMilestone)
        $response = $this->actingAs($admin)->putJson("/api/v1/admin/milestones/{$milestone2->id}", [
            'status' => 'completed',
        ]);
        $response->assertStatus(200);
        $this->assertEquals('completed', $milestone2->fresh()->status);

        // 4. Admin lists users
        $response = $this->actingAs($admin)->getJson('/api/v1/admin/users');
        $response->assertStatus(200);

        // 5. Admin provisions new user
        $response = $this->actingAs($admin)->postJson('/api/v1/admin/users', [
            'name' => 'New Vetter User',
            'email' => 'newvetter@example.com',
            'address' => 'Vetter Address',
            'phone' => '987654321',
            'role' => 'vetter',
            'vetter_level' => 2,
            'password' => 'newpassword123',
        ]);
        $response->assertStatus(201);
        $newVetter = User::where('email', 'newvetter@example.com')->first();
        $this->assertEquals('vetter_2', $newVetter->role);

        // 6. Admin suspends user
        $response = $this->actingAs($admin)->postJson("/api/v1/admin/users/{$creator->id}/suspend");
        $response->assertStatus(200);
        $this->assertFalse((bool)$creator->fresh()->is_active);

        // 7. Admin updates user role
        $response = $this->actingAs($admin)->putJson("/api/v1/admin/users/{$creator->id}/role", [
            'role' => 'sponsor',
        ]);
        $response->assertStatus(200);
        $this->assertEquals('sponsor', $creator->fresh()->role);

        // 8. Admin lists activity logs
        $response = $this->actingAs($admin)->getJson('/api/v1/admin/activity-logs');
        $response->assertStatus(200);


        // --- SECTION 2: VETTER PROJECTS & DELIVERABLES ---

        // 9. Vetter lists projects in queue
        $response = $this->actingAs($vetter)->getJson('/api/v1/vetter/projects');
        $response->assertStatus(200);

        // 10. Vetter views project in queue
        $response = $this->actingAs($vetter)->getJson("/api/v1/vetter/projects/{$project->id}");
        $response->assertStatus(200);

        // 11. Vetter updates their Level 1 milestone
        $response = $this->actingAs($vetter)->postJson("/api/v1/vetter/milestones/{$milestone1->id}/complete", [
            'status' => 'completed',
        ]);
        $response->assertStatus(200);
        $this->assertEquals('completed', $milestone1->fresh()->status);

        // 12. Vetter stats
        $response = $this->actingAs($vetter)->getJson('/api/v1/vetter/stats');
        $response->assertStatus(200);

        // 13. Create a deliverable
        $deliverable = ProjectDeliverable::create([
            'project_id' => $project->id,
            'title' => 'Deliverable 1',
            'description' => 'Test Deliverable',
            'file_name' => 'test.pdf',
            'file_path' => 'projects/deliverables/test.pdf',
            'status' => 'submitted',
        ]);

        // 14. Vetter lists deliverables
        $response = $this->actingAs($vetter)->getJson('/api/v1/vetter/deliverables');
        $response->assertStatus(200);

        // 15. Vetter views deliverable
        $response = $this->actingAs($vetter)->getJson("/api/v1/vetter/deliverables/{$deliverable->id}");
        $response->assertStatus(200);

        // 16. Vetter reviews deliverable
        $response = $this->actingAs($vetter)->postJson("/api/v1/vetter/deliverables/{$deliverable->id}/review", [
            'decision' => 'accepted',
            'remarks' => 'Looks good',
        ]);
        $response->assertStatus(200);


        // --- SECTION 3: USER PROFILE ---

        // 17. Get profile
        $response = $this->actingAs($admin)->getJson('/api/v1/me');
        $response->assertStatus(200);

        // 18. Update profile
        $response = $this->actingAs($admin)->putJson('/api/v1/me', [
            'name' => 'Admin Updated Name',
        ]);
        $response->assertStatus(200);
        $this->assertEquals('Admin Updated Name', $admin->fresh()->name);

        // 19. Upload avatar (using fake file instead of fake image to avoid GD dependency)
        $avatarFile = UploadedFile::fake()->create('avatar.jpg', 500, 'image/jpeg');
        $response = $this->actingAs($admin)->postJson('/api/v1/me/avatar', [
            'avatar' => $avatarFile,
        ]);
        $response->assertStatus(200);

        // 20. Change password
        $response = $this->actingAs($admin)->putJson('/api/v1/me/password', [
            'current_password' => 'password',
            'password' => 'newsecretpassword',
            'password_confirmation' => 'newsecretpassword',
        ]);
        $response->assertStatus(200);
    }

    public function test_check_email_role()
    {
        // 1. Check unregistered email
        $response = $this->postJson('/api/v1/auth/check-email', [
            'email' => 'doesnotexist@example.com',
        ]);
        $response->assertStatus(200);
        $this->assertNull($response['data']['role']);

        // 2. Check registered creator
        $creator = User::factory()->create(['role' => 'creator', 'email' => 'creator_test@example.com']);
        $response = $this->postJson('/api/v1/auth/check-email', [
            'email' => 'creator_test@example.com',
        ]);
        $response->assertStatus(200);
        $this->assertEquals('general', $response['data']['role']);

        // 3. Check registered admin
        $admin = User::factory()->create(['role' => 'admin', 'email' => 'admin_test@example.com']);
        $response = $this->postJson('/api/v1/auth/check-email', [
            'email' => 'admin_test@example.com',
        ]);
        $response->assertStatus(200);
        $this->assertEquals('admin', $response['data']['role']);

        // 4. Check registered vetter
        $vetter = User::factory()->create(['role' => 'vetter_3', 'email' => 'vetter_test@example.com']);
        $response = $this->postJson('/api/v1/auth/check-email', [
            'email' => 'vetter_test@example.com',
        ]);
        $response->assertStatus(200);
        $this->assertEquals('vetter', $response['data']['role']);
    }
}
