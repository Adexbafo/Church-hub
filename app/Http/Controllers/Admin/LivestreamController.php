<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLivestreamRequest;
use App\Http\Requests\UpdateLivestreamRequest;
use App\Models\Livestream;
use App\Models\MediaItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LivestreamController extends Controller
{
    public function index(): View
    {
        $livestreams = Livestream::with([
            'creator',
            'recording',
        ])
            ->latest('scheduled_at')
            ->paginate(10);

        return view('admin.livestreams.index', compact('livestreams'));
    }

    public function create(): View
    {
        $recordings = $this->videoMediaItems();

        return view('admin.livestreams.create', compact('recordings'));
    }

    public function store(StoreLivestreamRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['created_by'] = auth()->id();

        Livestream::create($data);

        return redirect()
            ->route('admin.livestreams.index')
            ->with('success', 'Livestream created successfully.');
    }

    public function edit(Livestream $livestream): View
    {
        $recordings = $this->videoMediaItems();

        return view('admin.livestreams.edit', compact(
            'livestream',
            'recordings'
        ));
    }

    public function update(
        UpdateLivestreamRequest $request,
        Livestream $livestream
    ): RedirectResponse {
        $livestream->update(
            $request->validated()
        );

        return redirect()
            ->route('admin.livestreams.index')
            ->with('success', 'Livestream updated successfully.');
    }

    public function destroy(
        Livestream $livestream
    ): RedirectResponse {
        $livestream->delete();

        return redirect()
            ->route('admin.livestreams.index')
            ->with('success', 'Livestream deleted successfully.');
    }

    private function videoMediaItems()
    {
        return MediaItem::where('media_type', 'video')
            ->where('is_published', true)
            ->orderBy('title')
            ->get();
    }
}
