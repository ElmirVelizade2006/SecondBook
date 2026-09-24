<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display all notifications for the authenticated user.
     */
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        $unreadCount = Notification::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->count();

        return view('Frontend.notifications', compact(
            'notifications',
            'unreadCount'
        ));
    }

    /**
     * Mark one notification as read.
     */
    public function markAsRead(Notification $notification)
    {
        abort_unless(
            $notification->user_id === auth()->id(),
            403
        );

        if (is_null($notification->read_at)) {
            $notification->update([
                'read_at' => now(),
            ]);
        }

        return redirect()
            ->route('frontend.notifications.index')
            ->with('success', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return redirect()
            ->route('frontend.notifications.index')
            ->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete one notification.
     */
    public function destroy(Notification $notification)
    {
        abort_unless(
            $notification->user_id === auth()->id(),
            403
        );

        $notification->delete();

        $unreadCount = Notification::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Notification deleted successfully.',
            'unread_count' => $unreadCount,
        ]);
    }
}