<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'phone',
        'nationality',
        'address',
        'field_of_specialty',
        'education_level',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'friendly_role',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * OTP codes issued for email verification.
     */
    public function verificationCodes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailVerificationCode::class);
    }

    /**
     * Projects created by this user.
     */
    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */

    public function isCreator(): bool
    {
        return strtolower($this->role) === 'creator';
    }

    public function isSponsor(): bool
    {
        return strtolower($this->role) === 'sponsor';
    }

    public function isVetter(): bool
    {
        $role = strtolower($this->role);
        return $role === 'vetter' || str_starts_with($role, 'vetter_');
    }

    public function isAdmin(): bool
    {
        return strtolower($this->role) === 'admin';
    }

    public function getFriendlyRoleAttribute(): string
    {
        switch (strtolower($this->role)) {
            case 'vetter_1':
                return 'Vetter (Level 1: Initial Screening)';
            case 'vetter_2':
                return 'Vetter (Level 2: Technical Review)';
            case 'vetter_3':
                return 'Vetter (Level 3: Final Approval)';
            case 'vetter':
                return 'Vetter';
            case 'sponsor':
                return 'Sponsor';
            case 'admin':
                return 'Admin';
            case 'creator':
                return 'Creator';
            default:
                return ucfirst($this->role);
        }
    }
}
