<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Member;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [

            'totalMembers' => Member::count(),

            'activeMembers' => Member::where(
                'membership_status',
                'active'
            )->count(),

            'totalEvents' => Event::count(),

            'totalAnnouncements' => Announcement::count(),

        ]);
    }
}
