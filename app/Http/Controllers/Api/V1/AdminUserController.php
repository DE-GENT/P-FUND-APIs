<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role');
        $query = User::query();
        if ($role) {
            if ($role === 'vetter') {
                $query->where(function($q) {
                    $q->where('role', 'vetter')
                      ->orWhere('role', 'like', 'vetter_%');
                });
            } else {
                $query->where('role', $role);
            }
        }
        return response()->json($query->latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'role' => ['required', Rule::in(['vetter', 'sponsor', 'admin'])],
            'vetter_level' => 'nullable|integer|between:1,3',
            'password' => 'required|string|min:8',
        ]);

        $role = $request->role;
        if ($role === 'vetter' && $request->has('vetter_level') && in_array($request->vetter_level, [1, 2, 3])) {
            $role = 'vetter_' . $request->vetter_level;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'address' => $request->address,
            'phone' => $request->phone,
            'is_active' => true,
        ]);

        // Log the activity
        \App\Models\ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'ACCOUNT_CREATED',
            'details' => "Created a new {$user->friendly_role} account for {$request->email}",
            'ip_address' => $request->ip()
        ]);

        try {
            \Illuminate\Support\Facades\Mail::to($user->email)->send(
                new \App\Mail\AccountProvisionedMail($user, $request->password)
            );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send provision email: ' . $e->getMessage());
        }

        // Create in-app notification for the new user
        \App\Models\Notification::create([
            'user_id' => $user->id,
            'type'    => 'account_created',
            'title'   => '🎉 Welcome to P-FUNDS!',
            'body'    => "Your " . $user->friendly_role . " account has been provisioned by an administrator. Log in with your email and temporary password.",
            'link'    => '/pages/auth/login.html',
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }

    public function suspend(Request $request, User $user)
    {
        // Toggle the is_active status
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'activated' : 'suspended';

        \App\Models\ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => $user->is_active ? 'ACCOUNT_ACTIVATED' : 'ACCOUNT_SUSPENDED',
            'details' => ucfirst($status) . " account for {$user->email}",
            'ip_address' => $request->ip()
        ]);

        return response()->json([
            'message' => "User successfully {$status}",
            'user' => $user
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', Rule::in(['vetter', 'sponsor', 'admin', 'vetter_1', 'vetter_2', 'vetter_3'])]
        ]);

        $oldRole = $user->role;
        $user->role = $request->role;
        $user->save();

        \App\Models\ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'ROLE_UPDATED',
            'details' => "Changed role for {$user->email} from {$oldRole} to {$request->role}",
            'ip_address' => $request->ip()
        ]);

        return response()->json([
            'message' => "User role updated successfully",
            'user' => $user
        ]);
    }
}
