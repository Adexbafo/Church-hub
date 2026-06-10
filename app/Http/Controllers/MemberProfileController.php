<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberProfileController extends Controller
{
    public function edit()
    {
        $member = Auth::user()->member;

        return view('admin.members.profile', compact('member'));
    }

    public function update(Request $request)
    {
        dd('controller reached');
    }

    
}