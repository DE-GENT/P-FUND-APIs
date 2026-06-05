<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/logout', function () {
    Auth::logout();
    if (request()->hasSession()) {
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
    return view('pages.auth.logout');
})->name('logout');

// --- Authentication Routes ---
Route::prefix('auth')->group(function () {
    Route::get('/login', function () {
        return view('pages.auth.login');
    })->name('login');

    Route::get('/signup', function () {
        return view('pages.auth.signup');
    })->name('signup');

    Route::get('/otp', function () {
        return view('pages.auth.OTP');
    })->name('otp');

    Route::get('/forgot-password', function () {
        return view('pages.auth.forgot-password-request-link');
    })->name('password.request');

    Route::get('/forgot-password/sent', function () {
        return view('pages.auth.forgot-password-email-sent');
    })->name('password.sent');

    Route::get('/reset-password', function () {
        return view('pages.auth.reset-password');
    })->name('password.reset');
});

// --- Dashboard Routes ---
Route::prefix('dashboard')->group(function () {
    // User / Client Dashboard
    Route::prefix('user')->group(function () {
        Route::get('/', function () { return view('pages.dashboard.user.dashboard'); })->name('user.dashboard');
        Route::get('/edit-update', function () { return view('pages.dashboard.user.edit-update'); })->name('user.edit-update');
        Route::get('/project-confirm', function () { return view('pages.dashboard.user.project-confirm'); })->name('user.project-confirm');
        Route::get('/project-review', function () { return view('pages.dashboard.user.project-review'); })->name('user.project-review');
        Route::get('/project-submit-1', function () { return view('pages.dashboard.user.project-sub1'); })->name('user.project-submit-1');
        Route::get('/project-submit-2', function () { return view('pages.dashboard.user.project-sub2'); })->name('user.project-submit-2');
        Route::get('/project-submit-3', function () { return view('pages.dashboard.user.project-sub3'); })->name('user.project-submit-3');
        Route::get('/project-submit-4', function () { return view('pages.dashboard.user.project-sub4'); })->name('user.project-submit-4');
        Route::get('/project-update', function () { return view('pages.dashboard.user.project-update'); })->name('user.project-update');
        Route::get('/profile', function () { return view('pages.dashboard.user.user-profile'); })->name('user.profile');
    });

    // Admin Dashboard
    Route::prefix('admin')->group(function () {
        Route::get('/', function () { return view('pages.dashboard.admin.ad_dashboard'); })->name('admin.dashboard');
        Route::get('/account-create', function () { return view('pages.dashboard.admin.ad_account_create'); })->name('admin.account-create');
        Route::get('/account-review', function () { return view('pages.dashboard.admin.ad_account_review'); })->name('admin.account-review');
        Route::get('/activity-logs', function () { return view('pages.dashboard.admin.ad_activity_logs'); })->name('admin.activity-logs');
        Route::get('/milestones', function () { return view('pages.dashboard.admin.ad_milestone_updates'); })->name('admin.milestones');
        Route::get('/profile', function () { return view('pages.dashboard.admin.ad_profile'); })->name('admin.profile');
        Route::get('/project-review', function () { return view('pages.dashboard.admin.ad_project_review'); })->name('admin.project-review');
        Route::get('/project-tracking', function () { return view('pages.dashboard.admin.ad_project_tracking'); })->name('admin.project-tracking');
        Route::get('/rejected-projects', function () { return view('pages.dashboard.admin.ad_rejected_projects'); })->name('admin.rejected-projects');
        Route::get('/role-assignment', function () { return view('pages.dashboard.admin.ad_role_assignment'); })->name('admin.role-assignment');
    });

    // Vetter Dashboard
    Route::prefix('vetter')->group(function () {
        Route::get('/', function () { return view('pages.dashboard.vetter.vt_dashboard'); })->name('vetter.dashboard');
        Route::get('/deliverables', function () { return view('pages.dashboard.vetter.vt_deliverables'); })->name('vetter.deliverables');
        Route::get('/profile', function () { return view('pages.dashboard.vetter.vt_profile'); })->name('vetter.profile');
        Route::get('/queue', function () { return view('pages.dashboard.vetter.vt_queue'); })->name('vetter.queue');
    });

    // Sponsor Dashboard
    Route::prefix('sponsor')->group(function () {
        Route::get('/', function () { return view('pages.dashboard.sponsor.dashboard'); })->name('sponsor.dashboard');
        Route::get('/new-projects', function () { return view('pages.dashboard.sponsor.new-projects'); })->name('sponsor.new-projects');
        Route::get('/profile', function () { return view('pages.dashboard.sponsor.profile'); })->name('sponsor.profile');
        Route::get('/project-review', function () { return view('pages.dashboard.sponsor.project-review'); })->name('sponsor.project-review');
    });
});
