<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    use ApiResponse;

    /*
    |--------------------------------------------------------------------------
    | GET /v1/me  — Fetch authenticated user's profile
    |--------------------------------------------------------------------------
    */
    public function show(Request $request)
    {
        $user = $request->user()->loadCount('projects');

        $avatarUrl = $user->avatar
            ? Storage::disk('public')->url($user->avatar)
            : null;

        return $this->success([
            'id'                 => $user->id,
            'name'               => $user->name,
            'email'              => $user->email,
            'role'               => $user->role,
            'avatar'             => $user->avatar,
            'avatar_url'         => $avatarUrl,
            'phone'              => $user->phone,
            'nationality'        => $user->nationality,
            'address'            => $user->address,
            'field_of_specialty' => $user->field_of_specialty,
            'education_level'    => $user->education_level,
            'email_verified_at'  => $user->email_verified_at,
            'projects_count'     => $user->projects_count,
            'created_at'         => $user->created_at,
        ], 'Profile retrieved successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | POST /v1/me/avatar  — Upload profile photo
    |--------------------------------------------------------------------------
    */
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ]);

        $user = $request->user();

        // Delete old avatar if it exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        \App\Models\ActivityLog::create([
            'user_id'    => $user->id,
            'action'     => 'AVATAR_UPLOADED',
            'details'    => "User uploaded a new profile picture",
            'ip_address' => $request->ip(),
        ]);

        return $this->success([
            'avatar'     => $path,
            'avatar_url' => Storage::disk('public')->url($path),
        ], 'Profile picture updated successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | PUT /v1/me  — Update profile info
    |--------------------------------------------------------------------------
    */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'               => ['sometimes', 'string', 'max:255'],
            'phone'              => ['sometimes', 'nullable', 'string', 'max:20'],
            'nationality'        => ['sometimes', 'nullable', 'string', 'max:100'],
            'address'            => ['sometimes', 'nullable', 'string', 'max:255'],
            'field_of_specialty' => ['sometimes', 'nullable', 'string', 'max:255'],
            'education_level'    => ['sometimes', 'nullable', 'in:phd,masters,bachelors'],
        ]);

        $user->update($validated);

        \App\Models\ActivityLog::create([
            'user_id'    => $user->id,
            'action'     => 'PROFILE_UPDATED',
            'details'    => "User updated their profile information",
            'ip_address' => $request->ip(),
        ]);

        return $this->success($user->fresh(), 'Profile updated successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | PUT /v1/me/password  — Change password
    |--------------------------------------------------------------------------
    */
    public function changePassword(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password'      => ['required', 'string'],
            'password'              => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->error('Current password is incorrect', 422);
        }

        $user->update(['password' => $request->password]);

        // Revoke all other tokens for security
        $currentToken = $request->user()->currentAccessToken();
        if ($currentToken && isset($currentToken->id)) {
            $user->tokens()->where('id', '!=', $currentToken->id)->delete();
        }

        \App\Models\ActivityLog::create([
            'user_id'    => $user->id,
            'action'     => 'PASSWORD_CHANGED',
            'details'    => "User changed their password",
            'ip_address' => $request->ip(),
        ]);

        return $this->success(null, 'Password changed successfully');
    }
}
