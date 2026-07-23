<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaItemRequest;
use App\Http\Requests\UpdateMediaItemRequest;
use App\Models\MediaAlbum;
use App\Models\MediaCategory;
use App\Models\MediaItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MediaItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mediaItems = MediaItem::with([
            'category:id,name',
            'album:id,title',
            'uploader:id,name',
        ])
            ->latest()
            ->paginate(15);

        return view('admin.media-items.index', compact('mediaItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = MediaCategory::orderBy('name')->get();

        $albums = MediaAlbum::orderBy('title')->get();

        return view('admin.media-items.create', compact(
            'categories',
            'albums'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaItemRequest $request)
    {
        $uploadedFile = $request->file('file');

        $path = $uploadedFile->store('media', 'public');

        MediaItem::create([
            'media_category_id' => $request->media_category_id,
            'media_album_id' => $request->media_album_id,

            'title' => $request->title,
            'description' => $request->description,

            'file_name' => basename($path),
            'original_name' => $uploadedFile->getClientOriginalName(),
            'file_path' => $path,

            'mime_type' => $uploadedFile->getMimeType(),
            'media_type' => $this->determineMediaType(
                $uploadedFile->getMimeType()
            ),

            'file_size' => $uploadedFile->getSize(),

            'thumbnail_path' => null,

            'uploaded_by' => auth()->id(),

            'views' => 0,
            'downloads' => 0,

            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()
            ->route('admin.media-items.index')
            ->with('success', 'Media uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MediaItem $mediaItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MediaItem $mediaItem)
    {
        $categories = MediaCategory::orderBy('name')->get();

        $albums = MediaAlbum::orderBy('title')->get();

        return view('admin.media-items.edit', compact(
            'mediaItem',
            'categories',
            'albums'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaItemRequest $request, MediaItem $mediaItem)
    {
        $validated = $request->validated();

        if ($request->hasFile('file')) {

            // Remove old file
            if (Storage::disk('public')->exists($mediaItem->file_path)) {
                Storage::disk('public')->delete($mediaItem->file_path);
            }

            $uploadedFile = $request->file('file');

            $path = $uploadedFile->store('media', 'public');

            $validated['file_name'] = basename($path);
            $validated['original_name'] = $uploadedFile->getClientOriginalName();
            $validated['file_path'] = $path;
            $validated['mime_type'] = $uploadedFile->getMimeType();
            $validated['file_size'] = $uploadedFile->getSize();
            $validated['media_type'] = $this->determineMediaType(
                $uploadedFile->getMimeType()
            );
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        $mediaItem->update($validated);

        return redirect()
            ->route('admin.media-items.index')
            ->with('success', 'Media item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaItem $mediaItem)
    {
        if (Storage::disk('public')->exists($mediaItem->file_path)) {
            Storage::disk('public')->delete($mediaItem->file_path);
        }

        $mediaItem->delete();

        return redirect()
            ->route('admin.media-items.index')
            ->with('success', 'Media item deleted successfully.');
    }

    public function download(MediaItem $mediaItem)
    {
        if (! Storage::disk('public')->exists($mediaItem->file_path)) {
            return redirect()
                ->route('admin.media-items.index')
                ->with('error', 'The requested file could not be found.');
        }

        return Storage::disk('public')->download(
            $mediaItem->file_path,
            $mediaItem->original_name
        );
    }

    private function determineMediaType(string $mimeType): string
    {
        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mimeType, 'video/')) {
            return 'video';
        }

        if (str_starts_with($mimeType, 'audio/')) {
            return 'audio';
        }

        return 'document';
    }
}
