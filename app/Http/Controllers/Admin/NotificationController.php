<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $notifications = \App\Models\Notification::query()

            ->when($search, function ($query) use ($search) {

                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.notifications.index', [

            'notifications' => $notifications,

            'totalNotifications' => \App\Models\Notification::count(),

            'activeNotifications' => \App\Models\Notification::active()->count(),

            'pinnedNotifications' => \App\Models\Notification::pinned()->count(),

            'unreadNotifications' => \App\Models\Notification::unread()->count(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'category' => ['required', 'string'],
            'audience' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'expires_at' => ['nullable', 'date'],
            'link' => ['nullable', 'url'],
            'attachment' => ['nullable', 'file', 'max:5120'],
        ]);

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request
                ->file('attachment')
                ->store('notifications', 'public');
        }

        $validated['created_by'] = auth()->id();

        $validated['published_at'] = now();

        $validated['is_active'] = true;

        \App\Models\Notification::create($validated);

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'Notification published successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Notification $notification)
    {
        return view(
            'admin.notifications.show',
            compact('notification')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Notification $notification)
    {
        return view(
            'admin.notifications.edit',
            compact('notification')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'category' => ['required', 'string'],
            'audience' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'expires_at' => ['nullable', 'date'],
            'link' => ['nullable', 'url'],
            'attachment' => ['nullable', 'file', 'max:5120'],
        ]);

        if ($request->hasFile('attachment')) {

            $validated['attachment'] = $request
                ->file('attachment')
                ->store('notifications', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $validated['is_pinned'] = $request->boolean('is_pinned');

        $notification->update($validated);

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'Notification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        if ($notification->attachment) {
            Storage::disk('public')->delete($notification->attachment);
        }

        $notification->delete();

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'Notification deleted successfully.');
    }
}
