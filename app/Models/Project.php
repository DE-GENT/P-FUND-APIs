<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Status Constants
    |--------------------------------------------------------------------------
    */
    public const STATUS_DRAFT        = 'draft';
    public const STATUS_SUBMITTED    = 'submitted';
    public const STATUS_UNDER_REVIEW = 'under_review';
    public const STATUS_APPROVED     = 'approved';
    public const STATUS_REJECTED     = 'rejected';
    public const STATUS_NEEDS_UPDATE = 'needs_update';

    public const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_SUBMITTED,
        self::STATUS_UNDER_REVIEW,
        self::STATUS_APPROVED,
        self::STATUS_REJECTED,
        self::STATUS_NEEDS_UPDATE,
    ];

    /*
    |--------------------------------------------------------------------------
    | Category Constants
    |--------------------------------------------------------------------------
    */
    public const CATEGORIES = [
        'technology',
        'health',
        'education',
        'agriculture',
        'environment',
        'other',
    ];

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'budget_amount',
        'budget_currency',
        'status',
        'admin_remarks',
        'submitted_at',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'budget_amount' => 'decimal:2',
            'submitted_at'  => 'datetime',
            'reviewed_at'   => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /** The creator who owns this project. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Alias for readability. */
    public function creator(): BelongsTo
    {
        return $this->user();
    }

    /** Uploaded proposal documents. */
    public function documents(): HasMany
    {
        return $this->hasMany(ProjectDocument::class);
    }

    /** Deliverables submitted after project approval. */
    public function deliverables(): HasMany
    {
        return $this->hasMany(ProjectDeliverable::class);
    }

    /** Milestones for project tracking/vetting. */
    public function milestones(): HasMany
    {
        return $this->hasMany(Milestone::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isSubmitted(): bool
    {
        return $this->status === self::STATUS_SUBMITTED;
    }

    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }
}
