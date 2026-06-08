<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(10);

        return view('admin.dashboard', compact('members'));
    }
}