<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMediaTeamRequest;
use App\Http\Requests\UpdateMediaTeamRequest;
use App\Models\MediaTeam;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MediaTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $mediaTeams = MediaTeam::with('user')
            ->orderBy('role')
            ->paginate(10);

        return view('admin.media-teams.index', compact('mediaTeams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.media-teams.create', [
            'users' => $this->mediaUsers(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaTeamRequest $request): RedirectResponse
    {
        MediaTeam::create($request->validated());

        return redirect()
            ->route('admin.media-teams.index')
            ->with('success', 'Media team member added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaTeam $mediaTeam)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaTeam $mediaTeam): View
    {
        return view('admin.media-teams.edit', [
            'mediaTeam' => $mediaTeam,
            'users' => $this->mediaUsers(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateMediaTeamRequest $request,
        MediaTeam $mediaTeam
    ): RedirectResponse {
        $mediaTeam->update($request->validated());

        return redirect()
            ->route('admin.media-teams.index')
            ->with('success', 'Media team member updated successfully.');
    }

    private function mediaUsers()
    {
        return User::orderBy('name')->get();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaTeam $mediaTeam): RedirectResponse
    {
        $mediaTeam->delete();

        return redirect()
            ->route('admin.media-teams.index')
            ->with('success', 'Media team member deleted successfully.');
    }
}
