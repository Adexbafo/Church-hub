<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\MemberManagementController;
use App\Http\Controllers\Admin\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::resource('members', MemberManagementController::class)
            ->names('admin.members');

        Route::resource('announcements', AnnouncementController::class)
            ->names('admin.announcements');
    });

Route::middleware(['auth'])->group(function () {

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

require __DIR__.'/auth.php';
