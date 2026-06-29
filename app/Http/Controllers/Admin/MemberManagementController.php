<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $gender = $request->input('gender');
        $baptized = $request->input('baptized');

        abort_unless(auth()->user()->role === 'admin', 403);

        $members = Member::query()

            ->when($search, function ($query) use ($search) {

                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('occupation', 'like', "%{$search}%")
                    ->orWhere('membership_id', 'like', "%{$search}%")
                    ->orWhere('band_one', 'like', "%{$search}%")
                    ->orWhere('band_two', 'like', "%{$search}%")
                    ->orWhere('band_three', 'like', "%{$search}%");
            })

            ->when($status, function ($query, $status) {
                $query->where('membership_status', $status);
            })

            ->when($gender, function ($query, $gender) {
                $query->where('gender', $gender);
            })

            ->when($request->filled('baptized'), function ($query) use ($baptized) {
                $query->where('is_baptized', $baptized);
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();



        return view('admin.members.index', [

            'newestMember' => Member::latest()->first(),

            'latestMemberId' => Member::latest()->value('membership_id'),

            'displayedMembers' => $members->count(),

            'members' => $members,

            'totalMembers' => Member::count(),

            'activeMembers' => Member::where(
                'membership_status',
                'active'
            )->count(),

            'inactiveMembers' => Member::where(
                'membership_status',
                'inactive'
            )->count(),

            'maleMembers' => Member::where(
                'gender',
                'male'
            )->count(),

            'femaleMembers' => Member::where(
                'gender',
                'female'
            )->count(),

            'baptizedMembers' => Member::where(
                'is_baptized',
                true
            )->count(),

        ]);
    }

    public function show(Member $member)
    {
        return view('admin.members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'occupation' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'joined_at' => ['nullable', 'date'],
            'membership_status' => ['required', 'string'],
            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'membership_id' => ['nullable', 'string', 'max:30'],

            'next_of_kin_name' => ['nullable', 'string'],
            'next_of_kin_relationship' => ['nullable', 'string'],
            'next_of_kin_phone' => ['nullable', 'string', 'max:30'],
            'next_of_kin_address' => ['nullable', 'string'],

            'band_name' => ['nullable', 'string', 'max:30'],
            'band_one' => ['nullable', 'string', 'max:50'],
            'band_two' => ['nullable', 'string', 'max:50'],
            'band_three' => ['nullable', 'string', 'max:50'],

            'gender' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date'],
            'marital_status' => ['nullable', 'string', 'max:30'],
            'is_baptized' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('profile_picture')) {

            if ($member->profile_picture) {

                Storage::disk('public')
                    ->delete($member->profile_picture);
            }

            $path = $request->file('profile_picture')
                ->store('members', 'public');

            $validated['profile_picture'] = $path;
        }

        $validated['is_baptized'] = $request->has('is_baptized');

        $member->update($validated);

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Member updated successfully.');
    }
    public function bulkAction(Request $request)
    {
        return back()->with(
            'info',
            'Bulk actions will be completed in a future update.'
        );
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return back()->with('success', 'Member deleted successfully.');
    }
}
