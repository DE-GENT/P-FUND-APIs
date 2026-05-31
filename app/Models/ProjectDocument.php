<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProjectDocument extends Model
{
    protected $fillable = [
        'project_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    /**
     * The project this document belongs to.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the public URL for this document.
     */
    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    /**
     * Delete the physical file when the model is deleted.
     */
    protected static function booted(): void
    {
        static::deleting(function (ProjectDocument $document) {
            Storage::disk('public')->delete($document->file_path);
        });
    }
}
