<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EmailVerificationCode;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(Request $request)// this line of code creates a method called register, it takes a request as an argument and save it in the variable $request and validate the request
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'unique:users'],
            'password'          => ['required', 'confirmed', Rules\Password::defaults()],
            'role'              => ['sometimes', 'in:creator,sponsor,admin,user'],
            'phone'             => ['nullable', 'string', 'max:20'],
            'nationality'       => ['nullable', 'string', 'max:100'],
            'address'           => ['nullable', 'string', 'max:255'],
            'field_of_specialty'=> ['nullable', 'string', 'max:255'],
            'education_level'   => ['nullable', 'in:phd,masters,bachelors'],
        ]);

        \Illuminate\Support\Facades\DB::beginTransaction();//A database transaction is used to bundle multiple database operations together so they either all succeed or all fail as a single unit (known as the "all-or-nothing" principle).
        try {
            $user  = User::create($validated);// create a user using the information store in $validated and save it in $user
            $token = $user->createToken('auth_token')->plainTextToken;
            
            \App\Models\ActivityLog::create([
                'user_id'    => $user->id,
                'action'     => 'USER_REGISTERED',
                'details'    => "User '{$user->name}' registered with role '{$user->role}'",
                'ip_address' => $request->ip(),
            ]);

            \Illuminate\Support\Facades\DB::commit();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Registration failed: ' . $e->getMessage());
            return $this->error('Failed to create account. Please try again later.', 500);
        }

        // Send verification email — best-effort, don't fail registration if email is down
        $emailSent = false;
        try {
            $otp = EmailVerificationCode::generateFor($user);
            $user->notify(new VerifyEmailNotification($otp->code));
            $emailSent = true;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Verification email failed: ' . $e->getMessage());
        }

        $message = $emailSent
            ? 'Account created. Please check your email for a verification code.'
            : 'Account created. Email could not be sent — use the resend option on the verification page.';

        return $this->success([
            'user'           => $user,
            'token'          => $token,
            'email_verified' => false,
            'email_sent'     => $emailSent,
        ], $message, 201);
    }

    /**
     * Verify the user's email with a 6-digit OTP code.
     */
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $user = $request->user();

        // Already verified?
        if ($user->hasVerifiedEmail()) {
            return $this->success(null, 'Email is already verified');
        }

        // Find the matching code
        $verification = EmailVerificationCode::where('user_id', $user->id)
            ->where('code', $request->code)
            ->first();

        if (!$verification) {
            return $this->error('Invalid verification code', 422);
        }

        if ($verification->isExpired()) {
            $verification->delete();
            return $this->error('Verification code has expired. Please request a new one.', 422);
        }

        // Mark email as verified and clean up
        $user->markEmailAsVerified();
        $verification->delete();

        \App\Models\ActivityLog::create([
            'user_id'    => $user->id,
            'action'     => 'USER_EMAIL_VERIFIED',
            'details'    => "User verified their email address '{$user->email}'",
            'ip_address' => $request->ip(),
        ]);

        return $this->success([
            'user'           => $user->fresh(),
            'email_verified' => true,
        ], 'Email verified successfully');
    }

    /**
     * Resend the verification OTP code.
     */
    public function resendVerificationCode(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return $this->success(null, 'Email is already verified');
        }

        // Generate new OTP (deletes old ones) and send
        $otp = EmailVerificationCode::generateFor($user);
        $user->notify(new VerifyEmailNotification($otp->code));

        return $this->success(null, 'Verification code sent to your email');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
            'role'     => ['required', 'string'],
        ]);
//Instructs Laravel to use the 'web' authentication guard. This guard is configured
        if (!Auth::guard('web')->validate($request->only('email', 'password'))) {
            return $this->error('Invalid email or password', 401);
        }

        $user  = User::where('email', $request->email)->first();
        
        // Ensure the user's role matches the portal they are trying to access
        $requestedRole = strtolower($request->role);
        $userRole = strtolower($user->role ?? 'general');

        // Map empty or 'creator' to 'general' for comparison
        if (in_array($userRole, ['', 'creator', 'general'])) {
            $userRole = 'general';
        }

        // Allow any vetter sub-role (vetter, vetter_1, vetter_2, vetter_3) when 'vetter' tab is selected
        $roleMatches = ($userRole === $requestedRole)
            || ($requestedRole === 'vetter' && str_starts_with($userRole, 'vetter'));

        if (!$roleMatches) {
            return $this->error("Access Denied: This account is not registered as a {$requestedRole}.", 403);
        }

        // Check if account is active (suspended accounts cannot log in)
        if (!$user->is_active) {
            return $this->error('Your account has been suspended. Please contact the administrator.', 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // Admin-provisioned accounts (is_active=true) are considered verified
        $emailVerified = $user->hasVerifiedEmail() || $user->is_active;

        \App\Models\ActivityLog::create([
            'user_id'    => $user->id,
            'action'     => 'USER_LOGGED_IN',
            'details'    => "User logged in with role '{$user->role}'",
            'ip_address' => $request->ip(),
        ]);

        return $this->success([
            'user'           => $user,
            'token'          => $token,
            'email_verified' => $emailVerified,
        ], 'Login successful');
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        
        \App\Models\ActivityLog::create([
            'user_id'    => $user->id,
            'action'     => 'USER_LOGGED_OUT',
            'details'    => "User logged out",
            'ip_address' => $request->ip(),
        ]);

        $user->currentAccessToken()->delete();

        return $this->success(null, 'Logged out successfully');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status !== Password::RESET_LINK_SENT) {
            return $this->error('Unable to send reset link', 400);
        }

        return $this->success(null, 'Password reset link sent to your email');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => $password])->save();
                $user->tokens()->delete();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return $this->error('Invalid or expired reset token', 400);
        }

        return $this->success(null, 'Password reset successfully');
    }

    public function checkEmailRole(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->success(['role' => null]);
        }

        $userRole = strtolower($user->role ?? 'general');

        if (in_array($userRole, ['', 'creator', 'general'])) {
            $userRole = 'general';
        } elseif (str_starts_with($userRole, 'vetter')) {
            $userRole = 'vetter';
        }

        return $this->success(['role' => $userRole]);
    }
}