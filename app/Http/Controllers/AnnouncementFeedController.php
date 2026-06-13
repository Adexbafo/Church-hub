<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementFeedController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->get();

        return view(
            'announcements.index',
            compact('announcements')
        );
    }
    public function show(Announcement $announcement)
    {
        return view(
            'announcements.show',
            compact('announcement')
        );
    }
}