<?php

namespace Tests\Feature;

use App\Models\EmailVerificationCode;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProjectSubmissionApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_full_project_submission_flow()
    {
        Storage::fake('public');

        // 1. Register a Creator User
        $registerData = [
            'name' => 'Creator User',
            'email' => 'creator@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'creator',
            'phone' => '1234567890',
            'nationality' => 'American',
            'address' => '123 Creator St',
            'field_of_specialty' => 'Software Development',
            'education_level' => 'masters',
        ];

        $response = $this->postJson('/api/v1/auth/register', $registerData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'user',
                    'token',
                    'email_verified',
                ],
                'message',
            ]);

        $this->assertFalse($response['data']['email_verified']);
        $creator = User::where('email', 'creator@example.com')->first();
        $this->assertNotNull($creator);
        $this->assertEquals('creator', $creator->role);

        // Get verification code from DB
        $verificationCode = EmailVerificationCode::where('user_id', $creator->id)->first();
        $this->assertNotNull($verificationCode);

        // Verify Email using Bearer token
        $verifyResponse = $this->withHeader('Authorization', 'Bearer ' . $response['data']['token'])
            ->postJson('/api/v1/auth/verify-email', [
                'code' => $verificationCode->code,
            ]);

        $verifyResponse->assertStatus(200);
        $this->assertTrue($creator->fresh()->hasVerifiedEmail());

        // Flush headers and reset guards so the old token does not interfere with the login request
        $this->flushHeaders();
        auth()->forgetGuards();

        // 2. Login
        // Note: As analyzed, creators map to 'general' portal role.
        $loginData = [
            'email' => 'creator@example.com',
            'password' => 'password123',
            'role' => 'general',
        ];

        $loginResponse = $this->postJson('/api/v1/auth/login', $loginData);
        $loginResponse->assertStatus(200);
        $token = $loginResponse['data']['token'];

        // 3. Create Draft Project
        $projectData = [
            'title' => 'Innovative Clean Energy Initiative',
            'description' => 'A project aiming to generate energy through innovative solar designs that scale up to community level.',
            'category' => 'environment',
            'budget_amount' => 50000.00,
            'budget_currency' => 'USD',
        ];

        $createResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/v1/projects', $projectData);

        $createResponse->assertStatus(201)
            ->assertJsonPath('data.status', 'draft')
            ->assertJsonPath('data.title', $projectData['title']);

        $projectId = $createResponse['data']['id'];

        // 4. Upload Documents
        $documentFile = UploadedFile::fake()->create('proposal.pdf', 500, 'application/pdf');
        $uploadResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson("/api/v1/projects/{$projectId}/documents", [
                'documents' => [$documentFile],
            ]);

        $uploadResponse->assertStatus(201);
        $this->assertCount(1, $uploadResponse['data']);
        $documentId = $uploadResponse['data'][0]['id'];

        // 5. Update Draft Project
        $updatedData = [
            'title' => 'Updated Solar Energy Project',
            'description' => 'This is a modified description to test the update project API endpoint.',
            'category' => 'environment',
            'budget_amount' => 55000.00,
            'budget_currency' => 'USD',
        ];

        $updateResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson("/api/v1/projects/{$projectId}", $updatedData);

        $updateResponse->assertStatus(200)
            ->assertJsonPath('data.title', $updatedData['title'])
            ->assertJsonPath('data.budget_amount', '55000.00');

        // 6. Submit Project
        $submitResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson("/api/v1/projects/{$projectId}/submit");

        $submitResponse->assertStatus(200)
            ->assertJsonPath('data.status', 'submitted');

        // Flush headers and reset guards so we can log in as a different user
        $this->flushHeaders();
        auth()->forgetGuards();

        // 7. Admin Review
        // Create Admin user
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword'),
        ]);
        $admin->markEmailAsVerified();

        // Login as Admin
        $adminLoginResponse = $this->postJson('/api/v1/auth/login', [
            'email' => 'admin@example.com',
            'password' => 'adminpassword',
            'role' => 'admin',
        ]);
        $adminLoginResponse->assertStatus(200);
        $adminToken = $adminLoginResponse['data']['token'];

        // Admin lists submitted projects
        $listResponse = $this->withHeader('Authorization', 'Bearer ' . $adminToken)
            ->getJson('/api/v1/admin/projects');

        $listResponse->assertStatus(200);
        $this->assertTrue(collect($listResponse['data']['data'])->contains('id', $projectId));

        // Admin reviews and approves project
        $reviewResponse = $this->withHeader('Authorization', 'Bearer ' . $adminToken)
            ->postJson("/api/v1/admin/projects/{$projectId}/review", [
                'decision' => 'approved',
                'remarks' => 'Highly promising approach.',
            ]);

        $reviewResponse->assertStatus(200)
            ->assertJsonPath('data.status', 'approved');

        // Flush headers and reset guards so we can act as the Creator again
        $this->flushHeaders();
        auth()->forgetGuards();

        // 8. Deliverable Submission (after project is approved)
        $deliverableFile = UploadedFile::fake()->create('report_q1.pdf', 1000, 'application/pdf');
        $deliverableResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson("/api/v1/projects/{$projectId}/deliverables", [
                'title' => 'Quarter 1 Progress Report',
                'description' => 'Initial architecture design and prototyping report.',
                'file' => $deliverableFile,
            ]);

        $deliverableResponse->assertStatus(201)
            ->assertJsonPath('data.status', 'submitted')
            ->assertJsonPath('data.title', 'Quarter 1 Progress Report');

        $deliverableId = $deliverableResponse['data']['id'];

        // Flush headers and reset guards so we can log in as the Vetter
        $this->flushHeaders();
        auth()->forgetGuards();

        // 9. Vetter Review
        // Create Vetter user
        $vetter = User::factory()->create([
            'role' => 'vetter',
            'email' => 'vetter@example.com',
            'password' => bcrypt('vetterpassword'),
        ]);
        $vetter->markEmailAsVerified();

        // Login as Vetter
        $vetterLoginResponse = $this->postJson('/api/v1/auth/login', [
            'email' => 'vetter@example.com',
            'password' => 'vetterpassword',
            'role' => 'vetter',
        ]);
        $vetterLoginResponse->assertStatus(200);
        $vetterToken = $vetterLoginResponse['data']['token'];

        // Vetter lists deliverables
        $vetterListResponse = $this->withHeader('Authorization', 'Bearer ' . $vetterToken)
            ->getJson('/api/v1/vetter/deliverables');

        $vetterListResponse->assertStatus(200);
        $this->assertTrue(collect($vetterListResponse['data']['data'])->contains('id', $deliverableId));

        // Vetter reviews and approves deliverable
        $vetterReviewResponse = $this->withHeader('Authorization', 'Bearer ' . $vetterToken)
            ->postJson("/api/v1/vetter/deliverables/{$deliverableId}/review", [
                'decision' => 'accepted',
                'remarks' => 'Deliverable meets all requirements.',
            ]);

        $vetterReviewResponse->assertStatus(200)
            ->assertJsonPath('data.status', 'accepted');
    }
}
