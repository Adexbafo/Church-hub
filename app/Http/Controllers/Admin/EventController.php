<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest('event_date')->paginate(10);

        $totalEvents = Event::count();

        return view('admin.events.index', compact(
            'events',
            'totalEvents'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => [
                'required',
                'in:general,worship,prayer,youth,conference,training,children,outreach'
            ],
            'event_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['nullable'],
            'venue' => ['required', 'string', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['nullable'],
            'venue' => ['required', 'string', 'max:255'],
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }
}
