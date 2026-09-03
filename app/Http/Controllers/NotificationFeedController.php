<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationFeedController extends Controller
{
    public function index()
    {
        $notifications = Notification::active()
            ->published()
            ->notExpired()
            ->latest('published_at')
            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function show(Notification $notification)
    {
        abort_if(
            ! $notification->is_active,
            404
        );

        abort_if(
            $notification->published_at &&
                $notification->published_at->isFuture(),
            404
        );

        abort_if(
            $notification->expires_at &&
                $notification->expires_at->isPast(),
            404
        );

        if (! $notification->read_at) {
            $notification->update([
                'read_at' => now(),
            ]);
        }

        return view(
            'notifications.show',
            compact('notification')
        );
    }
}
