<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $galleries = Gallery::latest()->paginate(10);

        $totalMedia = Gallery::count();

        return view('admin.galleries.index', compact(
            'galleries',
            'totalMedia'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreGalleryRequest $request
    ): RedirectResponse {
        $validated = $request->validated();

        $path = $request->file('media')->store(
            'gallery',
            'public'
        );

        Gallery::create([
            'title'         => $validated['title'],
            'description'   => $validated['description'] ?? null,
            'media_type'    => $validated['media_type'],
            'file_path'     => $path,
            'album'         => $validated['album'] ?? null,
            'is_featured'   => $request->boolean('is_featured'),
            'is_active'     => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Media uploaded successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery): View
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateGalleryRequest $request,
        Gallery $gallery
    ): RedirectResponse {
        $validated = $request->validated();

        if ($request->hasFile('file')) {

            if (
                $gallery->file_path &&
                Storage::disk('public')->exists($gallery->file_path)
            ) {
                Storage::disk('public')->delete($gallery->file_path);
            }

            $validated['file_path'] = $request
                ->file('file')
                ->store('gallery', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $gallery->update($validated);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Media updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        if (
            $gallery->file_path &&
            Storage::disk('public')->exists($gallery->file_path)
        ) {
            Storage::disk('public')->delete($gallery->file_path);
        }

        // Delete the database record
        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Media deleted successfully.');
    }
}
