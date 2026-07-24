<?php

namespace App\Http\Controllers;

use App\Enums\Role as RoleEnum;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

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

        return view(
            'dashboard',
            compact('latestAnnouncements')
        );
    }
}
