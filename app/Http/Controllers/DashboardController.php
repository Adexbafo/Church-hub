<?php

namespace App\Http\Controllers;

use App\Enums\Role as RoleEnum;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole(RoleEnum::SUPER_ADMIN->value)) {
            return redirect()->route('admin.dashboard');
        }

        $latestAnnouncements = Announcement::query()
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestGallery = Gallery::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->first();

        if (! $latestGallery) {
            $latestGallery = Gallery::where('is_active', true)
                ->latest()
                ->first();
        }

        return view(
            'dashboard',
            compact('latestAnnouncements', 'latestGallery')
        );
    }
}
