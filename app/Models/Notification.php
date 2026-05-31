<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'body',
        'link',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Scope: only unread */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /** Helper: mark as read */
    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }
}
