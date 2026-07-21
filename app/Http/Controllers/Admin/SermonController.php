<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreSermonRequest;
use App\Http\Requests\UpdateSermonRequest;
use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use App\Models\Sermon;

class SermonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sermons = Sermon::with([
            'creator',
            'audio',
            'video',
            'notes',
        ])
            ->latest('sermon_date')
            ->paginate(10);

        return view('admin.sermons.index', compact('sermons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $audioItems = $this->mediaItemsByType('audio');
        $videoItems = $this->mediaItemsByType('video');
        $noteItems  = $this->mediaItemsByType('document');

        return view('admin.sermons.create', compact(
            'audioItems',
            'videoItems',
            'noteItems'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSermonRequest $request)
    {
        $data = $request->validated();

        $data['created_by'] = auth()->id();

        Sermon::create($data);

        return redirect()
            ->route('admin.sermons.index')
            ->with('success', 'Sermon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sermon $sermon)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sermon $sermon)
    {
        $audioItems = $this->mediaItemsByType('audio');
        $videoItems = $this->mediaItemsByType('video');
        $noteItems  = $this->mediaItemsByType('document');

        return view('admin.sermons.edit', compact(
            'sermon',
            'audioItems',
            'videoItems',
            'noteItems'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSermonRequest $request, Sermon $sermon)
    {
        $sermon->update(
            $request->validated()
        );

        return redirect()
            ->route('admin.sermons.index')
            ->with('success', 'Sermon updated successfully.');
    }

    private function mediaItemsByType(string $type)
    {
        return MediaItem::where('media_type', $type)
            ->where('is_published', true)
            ->orderBy('title')
            ->get();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sermon $sermon)
    {
        $sermon->delete();

        return redirect()
            ->route('admin.sermons.index')
            ->with('success', 'Sermon deleted successfully.');
    }
}
