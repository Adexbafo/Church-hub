<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaAlbumRequest;
use App\Http\Requests\UpdateMediaAlbumRequest;
use App\Models\MediaAlbum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MediaAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $albums = MediaAlbum::latest()->paginate(10);

        return view('admin.media-albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.media-albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaAlbumRequest $request): RedirectResponse
    {
        MediaAlbum::create([
            'title' => $request->title,

            'slug' => Str::slug($request->title),

            'description' => $request->description,

            'event_date' => $request->event_date,

            'is_published' => $request->boolean('is_published'),

            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.media-albums.index')
            ->with('success', 'Media album created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaAlbum $mediaAlbum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaAlbum $mediaAlbum): View
    {
        return view('admin.media-albums.edit', compact('mediaAlbum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateMediaAlbumRequest $request,
        MediaAlbum $mediaAlbum
    ): RedirectResponse {
        $mediaAlbum->update([
            'title' => $request->title,

            'slug' => Str::slug($request->title),

            'description' => $request->description,

            'event_date' => $request->event_date,

            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()
            ->route('admin.media-albums.index')
            ->with('success', 'Media album updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaAlbum $mediaAlbum): RedirectResponse
    {
        $mediaAlbum->delete();

        return redirect()
            ->route('admin.media-albums.index')
            ->with('success', 'Media album deleted successfully.');
    }
}
