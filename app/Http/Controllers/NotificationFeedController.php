<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationFeedController extends Controller
{
    public function index()
    {
        $notifications = Notification::query()
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->latest('published_at')
            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function show(Notification $notification)
    {
        if (!$notification->read_at) {
            $notification->update([
                'read_at' => now(),
            ]);
        }

        return view('notifications.show', compact('notification'));
    }
}
