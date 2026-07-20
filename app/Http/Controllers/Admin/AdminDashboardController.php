<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Member;

class AdminDashboardController extends Controller
{
    public function index()
    {

        abort_unless(auth()->user()->role === 'admin', 403);

        return view('admin.dashboard', [
            'totalMembers' => Member::count(),
            'activeMembers' => Member::where('membership_status', 'active')->count(),
            'inactiveMembers' => Member::where('membership_status', 'inactive')->count(),
            'announcementCount' => Announcement::count(),
            'members' => Member::latest()->take(5)->get(),
        ]);
    }
}
