<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $middleware = ['auth', 'admin'];

    public function index(Request $request)
    {
        $user = Auth::user();
        $notifications = $user->notifications->sortByDesc('created_at')->paginate(20);
        $unreadCount = $user->unreadNotifications->count();

        $notifications->each(function ($notification) {
            $notification->time_ago = $notification->created_at->diffForHumans();
        });

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    public function unread()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications;
        
        $notifications->each(function ($notification) {
            $notification->time_ago = $notification->created_at->diffForHumans();
        });

        return response()->json([
            'notifications' => $notifications,
            'count' => $notifications->count()
        ]);
    }

    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->notifications->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    public function checkNew()
    {
        $user = Auth::user();
        $hasNew = $user->unreadNotifications->count() > 0;
        
        // Get latest notification if exists
        $latest = $user->notifications->sortByDesc('created_at')->first();
        
        return response()->json([
            'has_new' => $hasNew,
            'unread_count' => $user->unreadNotifications->count(),
            'latest_order' => $latest ? [
                'id' => $latest->data['order_id'],
                'number' => $latest->data['order_number'],
                'message' => $latest->data['message']
            ] : null
        ]);
    }
}