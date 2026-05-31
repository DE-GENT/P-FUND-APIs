<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\DeliverableController;
use App\Http\Controllers\Api\V1\AdminProjectController;
use App\Http\Controllers\Api\V1\AdminUserController;
use App\Http\Controllers\Api\V1\VetterDeliverableController;

// Test route
Route::get('/ping', fn () => response()->json([
    'success' => true,
    'message' => 'P-FUNDS API is alive!'
]));

// Public auth routes
Route::prefix('v1/auth')->group(function () {
    Route::post('/register',        [AuthController::class, 'register']);
    Route::post('/login',           [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password',  [AuthController::class, 'resetPassword']);
    Route::post('/check-email',     [AuthController::class, 'checkEmailRole']);

    // Authenticated auth routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout',                   [AuthController::class, 'logout']);
        Route::post('/verify-email',             [AuthController::class, 'verifyEmail']);
        Route::post('/resend-verification-code', [AuthController::class, 'resendVerificationCode']);
    });
});

// Protected routes
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {

    // Profile — any authenticated user
    Route::get('/me',              [ProfileController::class, 'show']);
    Route::put('/me',              [ProfileController::class, 'update']);
    Route::put('/me/password',     [ProfileController::class, 'changePassword']);
    Route::post('/me/avatar',      [ProfileController::class, 'uploadAvatar']);

    // Global Chat - any authenticated user
    Route::get('/chat',            [\App\Http\Controllers\Api\V1\ChatController::class, 'index']);
    Route::post('/chat',           [\App\Http\Controllers\Api\V1\ChatController::class, 'store']);

    // Notifications - any authenticated user
    Route::get('/notifications',                        [\App\Http\Controllers\Api\V1\NotificationController::class, 'index']);
    Route::post('/notifications/mark-all-read',         [\App\Http\Controllers\Api\V1\NotificationController::class, 'markAllRead']);
    Route::post('/notifications/{id}/read',             [\App\Http\Controllers\Api\V1\NotificationController::class, 'markRead']);

    // File Downloads — admin + vetter (auth checked inside controller)
    Route::get('/documents/{document}/download',         [\App\Http\Controllers\Api\V1\DocumentController::class, 'download']);
    Route::get('/deliverables/{deliverable}/download',   [\App\Http\Controllers\Api\V1\DocumentController::class, 'downloadDeliverable']);
    Route::get('/projects/{project}/all-documents',      [\App\Http\Controllers\Api\V1\DocumentController::class, 'projectFiles']);
    /*
    |----------------------------------------------------------------------
    | Creator — Project CRUD + Submission + Documents + Deliverables
    |----------------------------------------------------------------------
    */
    Route::middleware('role:creator')->prefix('projects')->group(function () {
        Route::get('/',                  [ProjectController::class, 'index']);
        Route::post('/',                 [ProjectController::class, 'store']);
        Route::get('/{project}',         [ProjectController::class, 'show']);
        Route::put('/{project}',         [ProjectController::class, 'update']);
        Route::delete('/{project}',      [ProjectController::class, 'destroy']);
        Route::post('/{project}/submit', [ProjectController::class, 'submit']);

        // Document management
        Route::post('/{project}/documents',            [ProjectController::class, 'uploadDocuments']);
        Route::delete('/{project}/documents/{document}', [ProjectController::class, 'deleteDocument']);

        // Deliverable submission
        Route::get('/{project}/deliverables',                [DeliverableController::class, 'index']);
        Route::post('/{project}/deliverables',               [DeliverableController::class, 'store']);
        Route::get('/{project}/deliverables/{deliverable}',  [DeliverableController::class, 'show']);
    });

    /*
    |----------------------------------------------------------------------
    | Admin — Project Review
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Project Management
        Route::get('/projects',                   [AdminProjectController::class, 'index']);
        Route::get('/projects/{project}',         [AdminProjectController::class, 'show']);
        Route::post('/projects/{project}/review', [AdminProjectController::class, 'review']);
        Route::put('/milestones/{milestone}',     [AdminProjectController::class, 'updateMilestone']);

        // User Management
        Route::get('/users',                      [AdminUserController::class, 'index']);
        Route::post('/users',                     [AdminUserController::class, 'store']);
        Route::post('/users/{user}/suspend',      [AdminUserController::class, 'suspend']);
        Route::put('/users/{user}/role',          [AdminUserController::class, 'updateRole']);

        // Activity Logs
        Route::get('/activity-logs',              [\App\Http\Controllers\Api\V1\ActivityLogController::class, 'index']);
    });

    /*
    |----------------------------------------------------------------------
    | Vetter — Deliverable Review
    |----------------------------------------------------------------------
    */
    Route::middleware('role:vetter')->prefix('vetter')->group(function () {
        // Projects in the vetting queue
        Route::get('/stats',                             [\App\Http\Controllers\Api\V1\VetterProjectController::class, 'stats']);
        Route::get('/projects',                          [\App\Http\Controllers\Api\V1\VetterProjectController::class, 'index']);
        Route::get('/projects/{project}',                [\App\Http\Controllers\Api\V1\VetterProjectController::class, 'show']);
        Route::post('/projects/{project}/require-update', [\App\Http\Controllers\Api\V1\VetterProjectController::class, 'requireUpdate']);
        Route::post('/projects/{project}/reject',         [\App\Http\Controllers\Api\V1\VetterProjectController::class, 'reject']);
        Route::post('/milestones/{milestone}/complete',  [\App\Http\Controllers\Api\V1\VetterProjectController::class, 'updateMilestone']);

        // Deliverables
        Route::get('/deliverables',                       [\App\Http\Controllers\Api\V1\VetterDeliverableController::class, 'index']);
        Route::get('/deliverables/{deliverable}',         [\App\Http\Controllers\Api\V1\VetterDeliverableController::class, 'show']);
        Route::post('/deliverables/{deliverable}/review', [\App\Http\Controllers\Api\V1\VetterDeliverableController::class, 'review']);
    });

    /*
    |----------------------------------------------------------------------
    | Sponsor — Project Funding & Tracking
    |----------------------------------------------------------------------
    */
    Route::middleware('role:sponsor')->prefix('sponsor')->group(function () {
        Route::get('/dashboard/stats', [\App\Http\Controllers\Api\V1\SponsorProjectController::class, 'dashboardStats']);
        Route::get('/projects', [\App\Http\Controllers\Api\V1\SponsorProjectController::class, 'index']);
        Route::get('/projects/reviewed', [\App\Http\Controllers\Api\V1\SponsorProjectController::class, 'reviewedProjects']);
        Route::get('/projects/{project}', [\App\Http\Controllers\Api\V1\SponsorProjectController::class, 'show']);
        Route::post('/projects/{project}/fund', [\App\Http\Controllers\Api\V1\SponsorProjectController::class, 'fund']);
        Route::post('/projects/{project}/interact', [\App\Http\Controllers\Api\V1\SponsorProjectController::class, 'interact']);
        Route::get('/my-funded-projects', [\App\Http\Controllers\Api\V1\SponsorProjectController::class, 'myFundedProjects']);
    });
});