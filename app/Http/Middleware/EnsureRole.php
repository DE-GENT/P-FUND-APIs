<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  string  ...$roles  One or more allowed roles (e.g. 'admin', 'vetter').
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        $userRole = strtolower($user?->role ?? '');

        $hasAccess = false;
        foreach (array_map('strtolower', $roles) as $required) {
            // Direct match
            if ($userRole === $required) { $hasAccess = true; break; }
            // Allow vetter_1, vetter_2, vetter_3 when 'vetter' is required
            if ($required === 'vetter' && str_starts_with($userRole, 'vetter')) { $hasAccess = true; break; }
        }

        if (!$user || !$hasAccess) {
            return response()->json([
                'success' => false,
                'message' => 'Access denied. You do not have the required role.',
            ], 403);
        }

        return $next($request);
    }
}
