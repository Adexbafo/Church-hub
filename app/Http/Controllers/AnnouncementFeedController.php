<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementFeedController extends Controller
{
    public function index()
    {
        $announcements = Announcement::query()
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(10);

        return view(
            'announcements.index',
            compact('announcements')
        );
    }

    public function show(Announcement $announcement)
    {
        abort_if(
            is_null($announcement->published_at),
            404
        );

        return view(
            'announcements.show',
            compact('announcement')
        );
    }
}
