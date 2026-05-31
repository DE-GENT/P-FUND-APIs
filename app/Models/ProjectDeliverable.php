<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProjectDeliverable extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Status Constants
    |--------------------------------------------------------------------------
    */
    public const STATUS_SUBMITTED    = 'submitted';
    public const STATUS_UNDER_REVIEW = 'under_review';
    public const STATUS_ACCEPTED     = 'accepted';
    public const STATUS_REJECTED     = 'rejected';

    public const STATUSES = [
        self::STATUS_SUBMITTED,
        self::STATUS_UNDER_REVIEW,
        self::STATUS_ACCEPTED,
        self::STATUS_REJECTED,
    ];

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'status',
        'reviewer_id',
        'review_remarks',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /** The vetter who reviewed this deliverable. */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function getUrlAttribute(): ?string
    {
        return $this->file_path
            ? Storage::disk('public')->url($this->file_path)
            : null;
    }

    protected static function booted(): void
    {
        static::deleting(function (ProjectDeliverable $deliverable) {
            if ($deliverable->file_path) {
                Storage::disk('public')->delete($deliverable->file_path);
            }
        });
    }
}
