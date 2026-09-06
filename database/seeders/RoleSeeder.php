<?php

namespace Database\Seeders;

use App\Enums\Permission;
use App\Enums\Role as RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $registrar = app(PermissionRegistrar::class);

        // Clear Spatie's permission cache before syncing roles.
        $registrar->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Super Administrator
        |--------------------------------------------------------------------------
        | Full access to every permission in the system.
        */
        $superAdmin = Role::findOrCreate(
            RoleEnum::SUPER_ADMIN->value,
            'web'
        );

        $superAdmin->syncPermissions(
            Permission::cases()
        );

        /*
        |--------------------------------------------------------------------------
        | Church Administrator
        |--------------------------------------------------------------------------
        | General church administration.
        |
        | No financial permissions.
        */
        $churchAdmin = Role::findOrCreate(
            RoleEnum::CHURCH_ADMIN->value,
            'web'
        );

        $churchAdmin->syncPermissions([
            // Members
            Permission::MEMBERS_VIEW,
            Permission::MEMBERS_CREATE,
            Permission::MEMBERS_EDIT,
            Permission::MEMBERS_DELETE,

            // Announcements
            Permission::ANNOUNCEMENTS_VIEW,
            Permission::ANNOUNCEMENTS_CREATE,
            Permission::ANNOUNCEMENTS_EDIT,
            Permission::ANNOUNCEMENTS_DELETE,

            // Notifications
            Permission::NOTIFICATIONS_VIEW,
            Permission::NOTIFICATIONS_CREATE,
            Permission::NOTIFICATIONS_EDIT,
            Permission::NOTIFICATIONS_DELETE,

            // Media Categories
            Permission::MEDIA_CATEGORIES_VIEW,
            Permission::MEDIA_CATEGORIES_CREATE,
            Permission::MEDIA_CATEGORIES_EDIT,
            Permission::MEDIA_CATEGORIES_DELETE,

            // Media Albums
            Permission::MEDIA_ALBUMS_VIEW,
            Permission::MEDIA_ALBUMS_CREATE,
            Permission::MEDIA_ALBUMS_EDIT,
            Permission::MEDIA_ALBUMS_DELETE,

            // Media Items
            Permission::MEDIA_ITEMS_VIEW,
            Permission::MEDIA_ITEMS_CREATE,
            Permission::MEDIA_ITEMS_EDIT,
            Permission::MEDIA_ITEMS_DELETE,
            Permission::MEDIA_ITEMS_DOWNLOAD,

            // Media Teams
            Permission::MEDIA_TEAMS_VIEW,
            Permission::MEDIA_TEAMS_CREATE,
            Permission::MEDIA_TEAMS_EDIT,
            Permission::MEDIA_TEAMS_DELETE,

            // Sermons
            Permission::SERMONS_VIEW,
            Permission::SERMONS_CREATE,
            Permission::SERMONS_EDIT,
            Permission::SERMONS_DELETE,

            // Livestreams
            Permission::LIVESTREAMS_VIEW,
            Permission::LIVESTREAMS_CREATE,
            Permission::LIVESTREAMS_EDIT,
            Permission::LIVESTREAMS_DELETE,

            // Events
            Permission::EVENTS_VIEW,
            Permission::EVENTS_CREATE,
            Permission::EVENTS_EDIT,
            Permission::EVENTS_DELETE,

            // Galleries
            Permission::GALLERIES_VIEW,
            Permission::GALLERIES_CREATE,
            Permission::GALLERIES_EDIT,
            Permission::GALLERIES_DELETE,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Pastor
        |--------------------------------------------------------------------------
        | Pastoral and content-related access.
        |
        | No financial permissions.
        */
        $pastor = Role::findOrCreate(
            RoleEnum::PASTOR->value,
            'web'
        );

        $pastor->syncPermissions([
            // Members
            Permission::MEMBERS_VIEW,

            // Announcements
            Permission::ANNOUNCEMENTS_VIEW,
            Permission::ANNOUNCEMENTS_CREATE,
            Permission::ANNOUNCEMENTS_EDIT,

            // Notifications
            Permission::NOTIFICATIONS_VIEW,

            // Sermons
            Permission::SERMONS_VIEW,
            Permission::SERMONS_CREATE,
            Permission::SERMONS_EDIT,

            // Livestreams
            Permission::LIVESTREAMS_VIEW,

            // Events
            Permission::EVENTS_VIEW,

            // Galleries
            Permission::GALLERIES_VIEW,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Finance Officer
        |--------------------------------------------------------------------------
        | Full operational access to the financial module.
        */
        $financeOfficer = Role::findOrCreate(
            RoleEnum::FINANCE_OFFICER->value,
            'web'
        );

        $financeOfficer->syncPermissions([
            // Financial Dashboard
            Permission::FINANCIAL_DASHBOARD_VIEW,

            // Fund Categories
            Permission::FUND_CATEGORIES_VIEW,
            Permission::FUND_CATEGORIES_CREATE,
            Permission::FUND_CATEGORIES_EDIT,
            Permission::FUND_CATEGORIES_DELETE,

            // Donations
            Permission::DONATIONS_VIEW,
            Permission::DONATIONS_CREATE,
            Permission::DONATIONS_EDIT,
            Permission::DONATIONS_DELETE,

            // Expenses
            Permission::EXPENSES_VIEW,
            Permission::EXPENSES_CREATE,
            Permission::EXPENSES_EDIT,
            Permission::EXPENSES_DELETE,

            // Financial Reports
            Permission::FINANCIAL_REPORTS_VIEW,
            Permission::FINANCIAL_REPORTS_EXPORT,

            // Audit Logs
            Permission::AUDIT_LOGS_VIEW,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Media Director
        |--------------------------------------------------------------------------
        | Responsible for church media and related content.
        */
        $mediaDirector = Role::findOrCreate(
            RoleEnum::MEDIA_DIRECTOR->value,
            'web'
        );

        $mediaDirector->syncPermissions([
            // Media Categories
            Permission::MEDIA_CATEGORIES_VIEW,
            Permission::MEDIA_CATEGORIES_CREATE,
            Permission::MEDIA_CATEGORIES_EDIT,
            Permission::MEDIA_CATEGORIES_DELETE,

            // Media Albums
            Permission::MEDIA_ALBUMS_VIEW,
            Permission::MEDIA_ALBUMS_CREATE,
            Permission::MEDIA_ALBUMS_EDIT,
            Permission::MEDIA_ALBUMS_DELETE,

            // Media Items
            Permission::MEDIA_ITEMS_VIEW,
            Permission::MEDIA_ITEMS_CREATE,
            Permission::MEDIA_ITEMS_EDIT,
            Permission::MEDIA_ITEMS_DELETE,
            Permission::MEDIA_ITEMS_DOWNLOAD,

            // Media Teams
            Permission::MEDIA_TEAMS_VIEW,
            Permission::MEDIA_TEAMS_CREATE,
            Permission::MEDIA_TEAMS_EDIT,
            Permission::MEDIA_TEAMS_DELETE,

            // Sermons
            Permission::SERMONS_VIEW,
            Permission::SERMONS_CREATE,
            Permission::SERMONS_EDIT,

            // Livestreams
            Permission::LIVESTREAMS_VIEW,
            Permission::LIVESTREAMS_CREATE,
            Permission::LIVESTREAMS_EDIT,
            Permission::LIVESTREAMS_DELETE,

            // Galleries
            Permission::GALLERIES_VIEW,
            Permission::GALLERIES_CREATE,
            Permission::GALLERIES_EDIT,
            Permission::GALLERIES_DELETE,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Member Manager
        |--------------------------------------------------------------------------
        | Responsible for member records.
        */
        $memberManager = Role::findOrCreate(
            RoleEnum::MEMBER_MANAGER->value,
            'web'
        );

        $memberManager->syncPermissions([
            Permission::MEMBERS_VIEW,
            Permission::MEMBERS_CREATE,
            Permission::MEMBERS_EDIT,
            Permission::MEMBERS_DELETE,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Communications Officer
        |--------------------------------------------------------------------------
        | Responsible for church-wide communication.
        */
        $communicationsOfficer = Role::findOrCreate(
            RoleEnum::COMMUNICATIONS_OFFICER->value,
            'web'
        );

        $communicationsOfficer->syncPermissions([
            // Announcements
            Permission::ANNOUNCEMENTS_VIEW,
            Permission::ANNOUNCEMENTS_CREATE,
            Permission::ANNOUNCEMENTS_EDIT,
            Permission::ANNOUNCEMENTS_DELETE,

            // Notifications
            Permission::NOTIFICATIONS_VIEW,
            Permission::NOTIFICATIONS_CREATE,
            Permission::NOTIFICATIONS_EDIT,
            Permission::NOTIFICATIONS_DELETE,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Volunteer
        |--------------------------------------------------------------------------
        | Read-only access to selected public-facing church content.
        */
        $volunteer = Role::findOrCreate(
            RoleEnum::VOLUNTEER->value,
            'web'
        );

        $volunteer->syncPermissions([
            Permission::ANNOUNCEMENTS_VIEW,
            Permission::NOTIFICATIONS_VIEW,
            Permission::EVENTS_VIEW,
            Permission::GALLERIES_VIEW,
            Permission::MEDIA_ITEMS_VIEW,
            Permission::MEDIA_ITEMS_DOWNLOAD,
            Permission::SERMONS_VIEW,
            Permission::LIVESTREAMS_VIEW,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Clear cache after synchronization
        |--------------------------------------------------------------------------
        */
        $registrar->forgetCachedPermissions();
    }
}
