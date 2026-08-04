<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'media_type' => ['required', 'in:image,video'],
            'album' => ['nullable', 'string', 'max:255'],
            'media' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp,mp4,mov,webm',
                'max:51200',
            ],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'media_type' => ['required', 'in:image,video'],
            'album' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable', 'file'],
        ]);

        if ($request->hasFile('file')) {

            Storage::disk('public')->delete($gallery->file_path);

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
    public function destroy(Gallery $gallery)
    {
        // Delete the uploaded file if it exists
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
