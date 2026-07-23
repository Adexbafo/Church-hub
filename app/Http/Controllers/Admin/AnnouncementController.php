<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role as RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Notification;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index()
    {
        abort_unless(
            auth()->user()->hasRole(RoleEnum::SUPER_ADMIN->value),
            403
        );

        $announcements = Announcement::latest()->get();

        return view(
            'admin.announcements.index',
            compact('announcements')
        );
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(StoreAnnouncementRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $request) {

            $announcement = Announcement::create([

                'title' => $validated['title'],
                'content' => $validated['content'],
                'user_id' => auth()->id(),
                'published_at' => now(),

            ]);

            if ($request->boolean('send_notification')) {

                Notification::create([

                    'created_by' => auth()->id(),

                    'title' => $announcement->title,

                    'message' => $announcement->content,

                    'category' => 'announcement',

                    'type' => 'announcement',

                    'audience' => 'all',

                    'priority' => 'normal',

                    'is_active' => true,

                    'is_pinned' => false,

                    'published_at' => now(),

                ]);
            }
        });

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

    public function update(
        UpdateAnnouncementRequest $request,
        Announcement $announcement
    ) {
        $validated = $request->validated();

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
