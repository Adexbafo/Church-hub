<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Member;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [

            'totalMembers' => Member::count(),

            'activeMembers' => Member::where(
                'membership_status',
                'active'
            )->count(),

            'totalAnnouncements' => Announcement::count(),

            'totalBands' => collect(
                Member::select(
                    'band_one',
                    'band_two',
                    'band_three'
                )->get()
            )
                ->flatMap(function ($member) {
                    return [
                        $member->band_one,
                        $member->band_two,
                        $member->band_three,
                    ];
                })
                ->filter()
                ->unique()
                ->count(),

        ]);
    }
}
