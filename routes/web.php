<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\MemberManagementController;
use App\Http\Controllers\Admin\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementFeedController;
use App\Models\Member;
use App\Models\Announcement;
use Illuminate\Support\Collection;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\NotificationFeedController;

Route::get('/', function () {

    return view('welcome', [

        'totalMembers' => Member::count(),

        'activeMembers' => Member::where('membership_status', 'active')->count(),

        'totalAnnouncements' => Announcement::count(),

        'totalBands' => collect(

            Member::select('band_one', 'band_two', 'band_three')->get()

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
});


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get(
            '/members/print',
            [MemberManagementController::class, 'print']
        )->name('admin.members.print');

        Route::get(
            '/members/export',
            [MemberManagementController::class, 'export']
        )->name('admin.members.export');

        Route::resource('members', MemberManagementController::class)
            ->names('admin.members');

        Route::resource('announcements', AnnouncementController::class)
            ->names('admin.announcements');

        Route::resource('notifications', NotificationController::class)
            ->names('admin.notifications');

        Route::post(
            '/members/bulk',
            [MemberManagementController::class, 'bulkAction']
        )->name('admin.members.bulk');
    });

Route::middleware(['auth'])->group(function () {

    Route::get('/announcements', [AnnouncementFeedController::class, 'index'])
        ->name('announcements.index');

    Route::get(
        '/announcements/{announcement}',
        [AnnouncementFeedController::class, 'show']
    )->name('announcements.show');

    Route::get('/notifications', [NotificationFeedController::class, 'index'])
        ->name('notifications.index');

    Route::get('/notifications/{notification}', [NotificationFeedController::class, 'show'])
        ->name('notifications.show');

    Route::get('/member/profile', [MemberProfileController::class, 'edit'])
        ->name('member.profile');

    Route::patch('/member/profile', [MemberProfileController::class, 'update'])
        ->name('member.profile.update');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__ . '/auth.php';
