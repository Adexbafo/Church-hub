<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\Notification;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->get();

        abort_unless(auth()->user()->role === 'admin', 403);

        return view(
            'admin.announcements.index',
            compact('announcements')
        );
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],

        ]);

        $announcement = Announcement::create([

            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'published_at' => now(),

        ]);
        if ($request->boolean('send_notification')) {

            Notification::create([

                'created_by'   => auth()->id(),

                'title'        => $announcement->title,

                'message'      => $announcement->content,

                'category'     => 'announcement',

                'type'         => 'announcement',

                'audience'     => 'all',

                'priority'     => 'normal',

                'is_active'    => true,

                'is_pinned'    => false,

                'published_at' => now(),

            ]);
        }
        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Announcement created successfully.');
    }

    public function edit(Announcement $announcement)
    {
        return view(
            'admin.announcements.edit',
            compact('announcement')
        );
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([

            'title' => 'required|string|max:255',
            'content' => 'required|string',

        ]);

        $announcement->update($validated);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }
}
