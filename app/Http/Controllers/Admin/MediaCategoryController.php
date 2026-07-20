<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaCategoryRequest;
use App\Http\Requests\UpdateMediaCategoryRequest;
use App\Models\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MediaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = MediaCategory::query()
            ->withCount('mediaItems')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.media-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.media-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaCategoryRequest $request): RedirectResponse
    {
        MediaCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.media-categories.index')
            ->with('success', 'Media category created successfully.');
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
    public function edit(MediaCategory $mediaCategory): View
    {
        return view('admin.media-categories.edit', [
            'category' => $mediaCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateMediaCategoryRequest $request,
        MediaCategory $mediaCategory
    ): RedirectResponse {

        $mediaCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.media-categories.index')
            ->with('success', 'Media category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MediaCategory $mediaCategory): RedirectResponse
    {
        if ($mediaCategory->mediaItems()->exists()) {
            return redirect()
                ->route('admin.media-categories.index')
                ->with(
                    'error',
                    'This category cannot be deleted because it contains media items.'
                );
        }

        $mediaCategory->delete();

        return redirect()
            ->route('admin.media-categories.index')
            ->with(
                'error',
                'This category cannot be deleted because it contains media items.'
            );
    }
}
