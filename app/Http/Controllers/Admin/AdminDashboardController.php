<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(10);

        abort_unless(auth()->user()->role === 'admin', 403);

        return view('admin.dashboard', compact('members'));
    }
}