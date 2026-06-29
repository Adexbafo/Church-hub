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
        $member = Auth::user()->member;

        $validated = $request->validate([
            'full_name' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'occupation' => ['nullable', 'string'],
            'joined_at' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'gender' => ['nullable', 'string'],
            'date_of_birth' => ['nullable', 'date'],
            'marital_status' => ['nullable', 'string'],
            'is_baptized' => ['nullable', 'boolean'],

            'next_of_kin_name' => ['nullable', 'string'],
            'next_of_kin_relationship' => ['nullable', 'string'],
            'next_of_kin_phone' => ['nullable', 'string'],
            'next_of_kin_address' => ['nullable', 'string'],
            'band_name' => ['nullable', 'string'],
            'band_one' => ['nullable', 'string', 'max:50'],
            'band_two' => ['nullable', 'string', 'max:50'],
            'band_three' => ['nullable', 'string', 'max:50'],
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

        $validated['is_baptized'] = $request->has('is_baptized');

        $member->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }
}
