<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('member.gallery.index', compact('galleries'));
    }

    public function show(Gallery $gallery)
    {
        if (! $gallery->is_active) {
            abort(404);
        }

        $previous = Gallery::where('id', '<', $gallery->id)
            ->where('is_active', true)
            ->latest('id')
            ->first();

        $next = Gallery::where('id', '>', $gallery->id)
            ->where('is_active', true)
            ->oldest('id')
            ->first();

        return view(
            'member.gallery.show',
            compact(
                'gallery',
                'previous',
                'next'
            )
        );
    }
}
