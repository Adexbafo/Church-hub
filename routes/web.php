<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\FinancialDashboardController;
use App\Http\Controllers\Admin\FinancialReportController;
use App\Http\Controllers\Admin\FundCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LivestreamController;
use App\Http\Controllers\Admin\MediaAlbumController;
use App\Http\Controllers\Admin\MediaCategoryController;
use App\Http\Controllers\Admin\MediaItemController;
use App\Http\Controllers\Admin\MediaTeamController;
use App\Http\Controllers\Admin\MemberManagementController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SermonController;
use App\Http\Controllers\AnnouncementFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Member\EventController as MemberEventController;
use App\Http\Controllers\Member\GalleryController as MemberGalleryController;
use App\Http\Controllers\MemberProfileController;
use App\Http\Controllers\NotificationFeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomeController::class, 'index'])
    ->name('welcome');


/*
|--------------------------------------------------------------------------
| Administrative Routes
|--------------------------------------------------------------------------
|
| All routes under /admin require:
|
| 1. Authentication
| 2. An administrative role
| 3. The specific permission required by the route
|
*/

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Members
        |--------------------------------------------------------------------------
        */

        Route::get('/members', [MemberManagementController::class, 'index'])
            ->middleware('permission:members.view')
            ->name('admin.members.index');

        Route::get('/members/print', [MemberManagementController::class, 'print'])
            ->middleware('permission:members.view')
            ->name('admin.members.print');

        Route::get('/members/export', [MemberManagementController::class, 'export'])
            ->middleware('permission:members.view')
            ->name('admin.members.export');

        Route::post('/members/bulk', [MemberManagementController::class, 'bulkAction'])
            ->middleware('permission:members.edit')
            ->name('admin.members.bulk');

        Route::get('/members/{member}', [MemberManagementController::class, 'show'])
            ->middleware('permission:members.view')
            ->name('admin.members.show');

        Route::get('/members/{member}/edit', [MemberManagementController::class, 'edit'])
            ->middleware('permission:members.edit')
            ->name('admin.members.edit');

        Route::put('/members/{member}', [MemberManagementController::class, 'update'])
            ->middleware('permission:members.edit')
            ->name('admin.members.update');

        Route::patch('/members/{member}', [MemberManagementController::class, 'update'])
            ->middleware('permission:members.edit')
            ->name('admin.members.update.patch');

        Route::delete('/members/{member}', [MemberManagementController::class, 'destroy'])
            ->middleware('permission:members.delete')
            ->name('admin.members.destroy');


        /*
        |--------------------------------------------------------------------------
        | Announcements
        |--------------------------------------------------------------------------
        */

        Route::get('/announcements', [AnnouncementController::class, 'index'])
            ->middleware('permission:announcements.view')
            ->name('admin.announcements.index');

        Route::get('/announcements/create', [AnnouncementController::class, 'create'])
            ->middleware('permission:announcements.create')
            ->name('admin.announcements.create');

        Route::post('/announcements', [AnnouncementController::class, 'store'])
            ->middleware('permission:announcements.create')
            ->name('admin.announcements.store');

        Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])
            ->middleware('permission:announcements.edit')
            ->name('admin.announcements.edit');

        Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])
            ->middleware('permission:announcements.edit')
            ->name('admin.announcements.update');

        Route::patch('/announcements/{announcement}', [AnnouncementController::class, 'update'])
            ->middleware('permission:announcements.edit')
            ->name('admin.announcements.update.patch');

        Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])
            ->middleware('permission:announcements.delete')
            ->name('admin.announcements.destroy');


        /*
|--------------------------------------------------------------------------
| Notifications
|--------------------------------------------------------------------------
*/

        Route::get('/notifications', [NotificationController::class, 'index'])
            ->middleware('permission:notifications.view')
            ->name('admin.notifications.index');

        Route::get('/notifications/create', [NotificationController::class, 'create'])
            ->middleware('permission:notifications.create')
            ->name('admin.notifications.create');

        Route::post('/notifications', [NotificationController::class, 'store'])
            ->middleware('permission:notifications.create')
            ->name('admin.notifications.store');

        Route::get('/notifications/{notification}', [NotificationController::class, 'show'])
            ->middleware('permission:notifications.view')
            ->name('admin.notifications.show');

        Route::get('/notifications/{notification}/edit', [NotificationController::class, 'edit'])
            ->middleware('permission:notifications.edit')
            ->name('admin.notifications.edit');

        Route::put('/notifications/{notification}', [NotificationController::class, 'update'])
            ->middleware('permission:notifications.edit')
            ->name('admin.notifications.update');

        Route::patch('/notifications/{notification}', [NotificationController::class, 'update'])
            ->middleware('permission:notifications.edit')
            ->name('admin.notifications.update.patch');

        Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])
            ->middleware('permission:notifications.delete')
            ->name('admin.notifications.destroy');

        /*
|--------------------------------------------------------------------------
| Media Categories
|--------------------------------------------------------------------------
*/

        Route::get('/media-categories', [MediaCategoryController::class, 'index'])
            ->middleware('permission:media-categories.view')
            ->name('admin.media-categories.index');

        Route::get('/media-categories/create', [MediaCategoryController::class, 'create'])
            ->middleware('permission:media-categories.create')
            ->name('admin.media-categories.create');

        Route::post('/media-categories', [MediaCategoryController::class, 'store'])
            ->middleware('permission:media-categories.create')
            ->name('admin.media-categories.store');

        Route::get('/media-categories/{media_category}/edit', [MediaCategoryController::class, 'edit'])
            ->middleware('permission:media-categories.edit')
            ->name('admin.media-categories.edit');

        Route::put('/media-categories/{media_category}', [MediaCategoryController::class, 'update'])
            ->middleware('permission:media-categories.edit')
            ->name('admin.media-categories.update');

        Route::patch('/media-categories/{media_category}', [MediaCategoryController::class, 'update'])
            ->middleware('permission:media-categories.edit')
            ->name('admin.media-categories.update.patch');

        Route::delete('/media-categories/{media_category}', [MediaCategoryController::class, 'destroy'])
            ->middleware('permission:media-categories.delete')
            ->name('admin.media-categories.destroy');

        /*
        |--------------------------------------------------------------------------
        | Media Albums
        |--------------------------------------------------------------------------
        */

        Route::get('/media-albums', [MediaAlbumController::class, 'index'])
            ->middleware('permission:media-albums.view')
            ->name('admin.media-albums.index');

        Route::get('/media-albums/create', [MediaAlbumController::class, 'create'])
            ->middleware('permission:media-albums.create')
            ->name('admin.media-albums.create');

        Route::post('/media-albums', [MediaAlbumController::class, 'store'])
            ->middleware('permission:media-albums.create')
            ->name('admin.media-albums.store');

        Route::get('/media-albums/{media_album}/edit', [MediaAlbumController::class, 'edit'])
            ->middleware('permission:media-albums.edit')
            ->name('admin.media-albums.edit');

        Route::put('/media-albums/{media_album}', [MediaAlbumController::class, 'update'])
            ->middleware('permission:media-albums.edit')
            ->name('admin.media-albums.update');

        Route::patch('/media-albums/{media_album}', [MediaAlbumController::class, 'update'])
            ->middleware('permission:media-albums.edit')
            ->name('admin.media-albums.update.patch');

        Route::delete('/media-albums/{media_album}', [MediaAlbumController::class, 'destroy'])
            ->middleware('permission:media-albums.delete')
            ->name('admin.media-albums.destroy');


        /*
        |--------------------------------------------------------------------------
        | Media Items
        |--------------------------------------------------------------------------
        */

        Route::get('/media-items', [MediaItemController::class, 'index'])
            ->middleware('permission:media-items.view')
            ->name('admin.media-items.index');

        Route::get('/media-items/create', [MediaItemController::class, 'create'])
            ->middleware('permission:media-items.create')
            ->name('admin.media-items.create');

        Route::post('/media-items', [MediaItemController::class, 'store'])
            ->middleware('permission:media-items.create')
            ->name('admin.media-items.store');

        Route::get('/media-items/{media_item}/download', [MediaItemController::class, 'download'])
            ->middleware('permission:media-items.download')
            ->name('admin.media-items.download');

        Route::get('/media-items/{media_item}/edit', [MediaItemController::class, 'edit'])
            ->middleware('permission:media-items.edit')
            ->name('admin.media-items.edit');

        Route::put('/media-items/{media_item}', [MediaItemController::class, 'update'])
            ->middleware('permission:media-items.edit')
            ->name('admin.media-items.update');

        Route::patch('/media-items/{media_item}', [MediaItemController::class, 'update'])
            ->middleware('permission:media-items.edit')
            ->name('admin.media-items.update.patch');

        Route::delete('/media-items/{media_item}', [MediaItemController::class, 'destroy'])
            ->middleware('permission:media-items.delete')
            ->name('admin.media-items.destroy');


        /*
        |--------------------------------------------------------------------------
        | Media Teams
        |--------------------------------------------------------------------------
        */

        Route::get('/media-teams', [MediaTeamController::class, 'index'])
            ->middleware('permission:media-teams.view')
            ->name('admin.media-teams.index');

        Route::get('/media-teams/create', [MediaTeamController::class, 'create'])
            ->middleware('permission:media-teams.create')
            ->name('admin.media-teams.create');

        Route::post('/media-teams', [MediaTeamController::class, 'store'])
            ->middleware('permission:media-teams.create')
            ->name('admin.media-teams.store');

        Route::get('/media-teams/{media_team}/edit', [MediaTeamController::class, 'edit'])
            ->middleware('permission:media-teams.edit')
            ->name('admin.media-teams.edit');

        Route::put('/media-teams/{media_team}', [MediaTeamController::class, 'update'])
            ->middleware('permission:media-teams.edit')
            ->name('admin.media-teams.update');

        Route::patch('/media-teams/{media_team}', [MediaTeamController::class, 'update'])
            ->middleware('permission:media-teams.edit')
            ->name('admin.media-teams.update.patch');

        Route::delete('/media-teams/{media_team}', [MediaTeamController::class, 'destroy'])
            ->middleware('permission:media-teams.delete')
            ->name('admin.media-teams.destroy');


        /*
        |--------------------------------------------------------------------------
        | Sermons
        |--------------------------------------------------------------------------
        */

        Route::get('/sermons', [SermonController::class, 'index'])
            ->middleware('permission:sermons.view')
            ->name('admin.sermons.index');

        Route::get('/sermons/create', [SermonController::class, 'create'])
            ->middleware('permission:sermons.create')
            ->name('admin.sermons.create');

        Route::post('/sermons', [SermonController::class, 'store'])
            ->middleware('permission:sermons.create')
            ->name('admin.sermons.store');

        Route::get('/sermons/{sermon}/edit', [SermonController::class, 'edit'])
            ->middleware('permission:sermons.edit')
            ->name('admin.sermons.edit');

        Route::put('/sermons/{sermon}', [SermonController::class, 'update'])
            ->middleware('permission:sermons.edit')
            ->name('admin.sermons.update');

        Route::patch('/sermons/{sermon}', [SermonController::class, 'update'])
            ->middleware('permission:sermons.edit')
            ->name('admin.sermons.update.patch');

        Route::delete('/sermons/{sermon}', [SermonController::class, 'destroy'])
            ->middleware('permission:sermons.delete')
            ->name('admin.sermons.destroy');


        /*
        |--------------------------------------------------------------------------
        | Livestreams
        |--------------------------------------------------------------------------
        */

        Route::get('/livestreams', [LivestreamController::class, 'index'])
            ->middleware('permission:livestreams.view')
            ->name('admin.livestreams.index');

        Route::get('/livestreams/create', [LivestreamController::class, 'create'])
            ->middleware('permission:livestreams.create')
            ->name('admin.livestreams.create');

        Route::post('/livestreams', [LivestreamController::class, 'store'])
            ->middleware('permission:livestreams.create')
            ->name('admin.livestreams.store');

        Route::get('/livestreams/{livestream}/edit', [LivestreamController::class, 'edit'])
            ->middleware('permission:livestreams.edit')
            ->name('admin.livestreams.edit');

        Route::put('/livestreams/{livestream}', [LivestreamController::class, 'update'])
            ->middleware('permission:livestreams.edit')
            ->name('admin.livestreams.update');

        Route::patch('/livestreams/{livestream}', [LivestreamController::class, 'update'])
            ->middleware('permission:livestreams.edit')
            ->name('admin.livestreams.update.patch');

        Route::delete('/livestreams/{livestream}', [LivestreamController::class, 'destroy'])
            ->middleware('permission:livestreams.delete')
            ->name('admin.livestreams.destroy');


        /*
        |--------------------------------------------------------------------------
        | Events
        |--------------------------------------------------------------------------
        */

        Route::get('/events', [EventController::class, 'index'])
            ->middleware('permission:events.view')
            ->name('admin.events.index');

        Route::get('/events/create', [EventController::class, 'create'])
            ->middleware('permission:events.create')
            ->name('admin.events.create');

        Route::post('/events', [EventController::class, 'store'])
            ->middleware('permission:events.create')
            ->name('admin.events.store');

        Route::get('/events/{event}/edit', [EventController::class, 'edit'])
            ->middleware('permission:events.edit')
            ->name('admin.events.edit');

        Route::put('/events/{event}', [EventController::class, 'update'])
            ->middleware('permission:events.edit')
            ->name('admin.events.update');

        Route::patch('/events/{event}', [EventController::class, 'update'])
            ->middleware('permission:events.edit')
            ->name('admin.events.update.patch');

        Route::delete('/events/{event}', [EventController::class, 'destroy'])
            ->middleware('permission:events.delete')
            ->name('admin.events.destroy');


        /*
        |--------------------------------------------------------------------------
        | Galleries
        |--------------------------------------------------------------------------
        */

        Route::get('/galleries', [GalleryController::class, 'index'])
            ->middleware('permission:galleries.view')
            ->name('admin.galleries.index');

        Route::get('/galleries/create', [GalleryController::class, 'create'])
            ->middleware('permission:galleries.create')
            ->name('admin.galleries.create');

        Route::post('/galleries', [GalleryController::class, 'store'])
            ->middleware('permission:galleries.create')
            ->name('admin.galleries.store');

        Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])
            ->middleware('permission:galleries.edit')
            ->name('admin.galleries.edit');

        Route::put('/galleries/{gallery}', [GalleryController::class, 'update'])
            ->middleware('permission:galleries.edit')
            ->name('admin.galleries.update');

        Route::patch('/galleries/{gallery}', [GalleryController::class, 'update'])
            ->middleware('permission:galleries.edit')
            ->name('admin.galleries.update.patch');

        Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy'])
            ->middleware('permission:galleries.delete')
            ->name('admin.galleries.destroy');


        /*
        |--------------------------------------------------------------------------
        | Financial Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/financial-dashboard',
            [FinancialDashboardController::class, 'index']
        )
            ->middleware('permission:financial.dashboard.view')
            ->name('admin.financial.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Fund Categories
        |--------------------------------------------------------------------------
        */

        Route::get('/fund-categories', [FundCategoryController::class, 'index'])
            ->middleware('permission:fund-categories.view')
            ->name('admin.fund-categories.index');

        Route::get('/fund-categories/create', [FundCategoryController::class, 'create'])
            ->middleware('permission:fund-categories.create')
            ->name('admin.fund-categories.create');

        Route::post('/fund-categories', [FundCategoryController::class, 'store'])
            ->middleware('permission:fund-categories.create')
            ->name('admin.fund-categories.store');

        Route::get('/fund-categories/{fundCategory}/edit', [FundCategoryController::class, 'edit'])
            ->middleware('permission:fund-categories.edit')
            ->name('admin.fund-categories.edit');

        Route::put('/fund-categories/{fundCategory}', [FundCategoryController::class, 'update'])
            ->middleware('permission:fund-categories.edit')
            ->name('admin.fund-categories.update');

        Route::patch('/fund-categories/{fundCategory}', [FundCategoryController::class, 'update'])
            ->middleware('permission:fund-categories.edit')
            ->name('admin.fund-categories.update.patch');

        Route::delete('/fund-categories/{fundCategory}', [FundCategoryController::class, 'destroy'])
            ->middleware('permission:fund-categories.delete')
            ->name('admin.fund-categories.destroy');


        /*
        |--------------------------------------------------------------------------
        | Donations
        |--------------------------------------------------------------------------
        */

        Route::get('/donations', [DonationController::class, 'index'])
            ->middleware('permission:donations.view')
            ->name('admin.donations.index');

        Route::get('/donations/create', [DonationController::class, 'create'])
            ->middleware('permission:donations.create')
            ->name('admin.donations.create');

        Route::post('/donations', [DonationController::class, 'store'])
            ->middleware('permission:donations.create')
            ->name('admin.donations.store');

        Route::get('/donations/{donation}', [DonationController::class, 'show'])
            ->middleware('permission:donations.view')
            ->name('admin.donations.show');

        Route::get('/donations/{donation}/edit', [DonationController::class, 'edit'])
            ->middleware('permission:donations.edit')
            ->name('admin.donations.edit');

        Route::put('/donations/{donation}', [DonationController::class, 'update'])
            ->middleware('permission:donations.edit')
            ->name('admin.donations.update');

        Route::patch('/donations/{donation}', [DonationController::class, 'update'])
            ->middleware('permission:donations.edit')
            ->name('admin.donations.update.patch');

        Route::delete('/donations/{donation}', [DonationController::class, 'destroy'])
            ->middleware('permission:donations.delete')
            ->name('admin.donations.destroy');


        /*
        |--------------------------------------------------------------------------
        | Expenses
        |--------------------------------------------------------------------------
        */

        Route::get('/expenses', [ExpenseController::class, 'index'])
            ->middleware('permission:expenses.view')
            ->name('admin.expenses.index');

        Route::get('/expenses/create', [ExpenseController::class, 'create'])
            ->middleware('permission:expenses.create')
            ->name('admin.expenses.create');

        Route::post('/expenses', [ExpenseController::class, 'store'])
            ->middleware('permission:expenses.create')
            ->name('admin.expenses.store');

        Route::get('/expenses/{expense}', [ExpenseController::class, 'show'])
            ->middleware('permission:expenses.view')
            ->name('admin.expenses.show');

        Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])
            ->middleware('permission:expenses.edit')
            ->name('admin.expenses.edit');

        Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])
            ->middleware('permission:expenses.edit')
            ->name('admin.expenses.update');

        Route::patch('/expenses/{expense}', [ExpenseController::class, 'update'])
            ->middleware('permission:expenses.edit')
            ->name('admin.expenses.update.patch');

        Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])
            ->middleware('permission:expenses.delete')
            ->name('admin.expenses.destroy');


        /*
        |--------------------------------------------------------------------------
        | Financial Reports
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/financial-reports',
            [FinancialReportController::class, 'index']
        )
            ->middleware('permission:financial-reports.view')
            ->name('admin.financial-reports.index');

        Route::get(
            '/financial-reports/export/csv',
            [FinancialReportController::class, 'exportCsv']
        )
            ->middleware('permission:financial-reports.export')
            ->name('admin.financial-reports.export.csv');

        Route::get(
            '/financial-reports/export/pdf',
            [FinancialReportController::class, 'exportPdf']
        )
            ->middleware('permission:financial-reports.export')
            ->name('admin.financial-reports.export.pdf');


        /*
        |--------------------------------------------------------------------------
        | Audit Logs
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/audit-logs',
            [AuditLogController::class, 'index']
        )
            ->middleware('permission:audit-logs.view')
            ->name('admin.audit-logs.index');
    });


/*
|--------------------------------------------------------------------------
| Authenticated Member Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Announcement Feed
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/announcements',
        [AnnouncementFeedController::class, 'index']
    )
        ->name('announcements.index');

    Route::get(
        '/announcements/{announcement}',
        [AnnouncementFeedController::class, 'show']
    )
        ->name('announcements.show');


    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/notifications',
        [NotificationFeedController::class, 'index']
    )
        ->name('notifications.index');

    Route::get(
        '/notifications/{notification}',
        [NotificationFeedController::class, 'show']
    )
        ->name('notifications.show');


    /*
    |--------------------------------------------------------------------------
    | Member Area
    |--------------------------------------------------------------------------
    */

    Route::prefix('member')
        ->name('member.')
        ->group(function () {

            /*
            | Member Profile
            */

            Route::get(
                '/profile',
                [MemberProfileController::class, 'edit']
            )
                ->name('profile');

            Route::patch(
                '/profile',
                [MemberProfileController::class, 'update']
            )
                ->name('profile.update');


            /*
            | Events
            */

            Route::resource('events', MemberEventController::class)
                ->only(['index', 'show']);


            /*
            | Gallery
            */

            Route::resource('gallery', MemberGalleryController::class)
                ->only(['index', 'show']);
        });


    /*
    |--------------------------------------------------------------------------
    | General Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )
        ->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )
        ->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| General Dashboard
|--------------------------------------------------------------------------
*/

Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)
    ->middleware(['auth'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
