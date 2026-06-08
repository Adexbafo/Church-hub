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

        return view('member.profile', compact('member'));
    }

    public function update(Request $request)
    {
        $member = Auth::user()->member;

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string'],
            'gender' => ['nullable', 'string'],
            'date_of_birth' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'occupation' => ['nullable', 'string'],
            'marital_status' => ['nullable', 'string'],
            'joined_at' => ['nullable', 'date'],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('profile_picture')) {

            if ($member->profile_picture) {
                Storage::disk('public')
                    ->delete($member->profile_picture);
            }

            $validated['profile_picture'] = $request
                ->file('profile_picture')
                ->store('members', 'public');
        }

        $member->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }
}