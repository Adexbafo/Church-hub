<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of upcoming events.
     */
    public function index()
    {
        $events = Event::where('is_active', true)
            ->orderBy('event_date')
            ->paginate(9);

        return view('member.events.index', compact('events'));
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        abort_if(
            !$event->is_active,
            404
        );

        return view('member.events.show', compact('event'));
    }
}
