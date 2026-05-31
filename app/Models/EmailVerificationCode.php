<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailVerificationCode extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }

    /**
     * The user this verification code belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if this code has expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Generate a new 6-digit OTP for a user.
     * Deletes any existing codes for the user first.
     */
    public static function generateFor(User $user): self
    {
        // Remove any existing codes for this user
        static::where('user_id', $user->id)->delete();

        return static::create([
            'user_id'    => $user->id,
            'code'       => str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'expires_at' => now()->addMinutes(15),
        ]);
    }
}
