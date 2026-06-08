<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $members = Member::query()
            ->when($search, function ($query) use ($search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('occupation', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.members.index', compact('members'));
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
            'membership_status' => ['required', 'string'],
        ]);

        $member->update($validated);

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return back()->with('success', 'Member deleted successfully.');
    }
}