<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\FinancialDashboardController;
use App\Http\Controllers\Admin\FinancialReportController;
use App\Http\Controllers\Admin\FundCategoryController;
use App\Http\Controllers\Admin\MediaAlbumController;
use App\Http\Controllers\Admin\MediaCategoryController;
use App\Http\Controllers\Admin\MediaItemController;
use App\Http\Controllers\Admin\MemberManagementController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\AnnouncementFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberProfileController;
use App\Http\Controllers\NotificationFeedController;
use App\Http\Controllers\ProfileController;
use App\Models\Announcement;
use App\Models\Member;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SermonController;
use App\Http\Controllers\Admin\LivestreamController;
use App\Http\Controllers\Admin\MediaTeamController;
use App\Http\Controllers\WelcomeController;



Route::get('/', [WelcomeController::class, 'index'])
    ->name('welcome');

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

        Route::get(
            'media-items/{media_item}/download',
            [MediaItemController::class, 'download']
        )->name('admin.media-items.download');

        Route::resource('media-categories', MediaCategoryController::class)
            ->names('admin.media-categories');
        Route::resource('media-albums', MediaAlbumController::class)
            ->names('admin.media-albums');
        Route::resource('media-items', MediaItemController::class)
            ->names('admin.media-items');
        Route::resource(
            'media-teams',
            MediaTeamController::class
        )->names('admin.media-teams');
        Route::resource('sermons', SermonController::class)
            ->except('show')
            ->names('admin.sermons');
        Route::resource('livestreams', LivestreamController::class)
            ->names('admin.livestreams');
    });

Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::get(
            '/financial-dashboard',
            [FinancialDashboardController::class, 'index']
        )
            ->middleware('financial:dashboard')
            ->name('admin.financial.dashboard');

        Route::resource(
            'fund-categories',
            FundCategoryController::class
        )
            ->middleware('financial:dashboard')
            ->names('admin.fund-categories');

        Route::resource(
            'donations',
            DonationController::class
        )
            ->middleware('financial:donations')
            ->names('admin.donations');

        Route::resource(
            'expenses',
            ExpenseController::class
        )
            ->middleware('financial:expenses')
            ->names('admin.expenses');

        Route::get(
            '/financial-reports',
            [FinancialReportController::class, 'index']
        )
            ->middleware('financial:reports')
            ->name('admin.financial-reports.index');

        Route::get(
            '/audit-logs',
            [AuditLogController::class, 'index']
        )
            ->middleware('financial:audit')
            ->name('admin.audit-logs.index');

        Route::get(
            '/financial-reports/export/csv',
            [FinancialReportController::class, 'exportCsv']
        )
            ->middleware('financial:exports')
            ->name('admin.financial-reports.export.csv');

        Route::get(
            '/financial-reports/export/pdf',
            [FinancialReportController::class, 'exportPdf']
        )
            ->middleware('financial:exports')
            ->name('admin.financial-reports.export.pdf');
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
