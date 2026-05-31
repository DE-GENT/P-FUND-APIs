<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * GET /v1/notifications
     * Returns latest 30 notifications for the logged-in user.
     */
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id', $request->user()->id)
            ->latest()
            ->take(30)
            ->get();

        $unreadCount = Notification::where('user_id', $request->user()->id)
            ->unread()
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count'  => $unreadCount,
        ]);
    }

    /**
     * POST /v1/notifications/mark-all-read
     * Mark all notifications as read for the logged-in user.
     */
    public function markAllRead(Request $request)
    {
        Notification::where('user_id', $request->user()->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['message' => 'All notifications marked as read.']);
    }

    /**
     * POST /v1/notifications/{id}/read
     * Mark a single notification as read.
     */
    public function markRead(Request $request, $id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $notification->markAsRead();

        return response()->json(['message' => 'Notification marked as read.']);
    }
}
