<?php

namespace Database\Seeders;

use App\Enums\Permission;
use App\Enums\Role as RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        /*
         * Super Administrator
         */
        $superAdmin = Role::findOrCreate(RoleEnum::SUPER_ADMIN->value, 'web');

        $superAdmin->syncPermissions(Permission::values());

        /*
         * Church Administrator
         */
        $churchAdmin = Role::findOrCreate(
            RoleEnum::CHURCH_ADMIN->value,
            'web'
        );

        $churchAdmin->syncPermissions([
            Permission::FINANCIAL_DASHBOARD_VIEW->value,
            Permission::FINANCIAL_REPORTS_VIEW->value,
        ]);

        /*
         * Pastor
         */
        $pastor = Role::findOrCreate(
            RoleEnum::PASTOR->value,
            'web'
        );

        $pastor->syncPermissions([
            Permission::FINANCIAL_DASHBOARD_VIEW->value,
            Permission::FINANCIAL_REPORTS_VIEW->value,
        ]);

        /*
         * Finance Officer
         */
        $financeOfficer = Role::findOrCreate(
            RoleEnum::FINANCE_OFFICER->value,
            'web'
        );

        $financeOfficer->syncPermissions([
            Permission::FINANCIAL_DASHBOARD_VIEW->value,

            Permission::FUND_CATEGORIES_VIEW->value,
            Permission::FUND_CATEGORIES_CREATE->value,
            Permission::FUND_CATEGORIES_EDIT->value,
            Permission::FUND_CATEGORIES_DELETE->value,

            Permission::DONATIONS_VIEW->value,
            Permission::DONATIONS_CREATE->value,
            Permission::DONATIONS_EDIT->value,
            Permission::DONATIONS_DELETE->value,

            Permission::EXPENSES_VIEW->value,
            Permission::EXPENSES_CREATE->value,
            Permission::EXPENSES_EDIT->value,
            Permission::EXPENSES_DELETE->value,

            Permission::FINANCIAL_REPORTS_VIEW->value,
            Permission::FINANCIAL_REPORTS_EXPORT->value,

            Permission::AUDIT_LOGS_VIEW->value,
        ]);

        /*
         * Media Director
         */
        $mediaDirector = Role::findOrCreate(
            RoleEnum::MEDIA_DIRECTOR->value,
            'web'
        );

        $mediaDirector->syncPermissions([]);

        /*
         * Member Manager
         */
        $memberManager = Role::findOrCreate(
            RoleEnum::MEMBER_MANAGER->value,
            'web'
        );

        $memberManager->syncPermissions([]);

        /*
         * Communications Officer
         */
        $communicationsOfficer = Role::findOrCreate(
            RoleEnum::COMMUNICATIONS_OFFICER->value,
            'web'
        );

        $communicationsOfficer->syncPermissions([]);

        /*
         * Volunteer
         */
        $volunteer = Role::findOrCreate(
            RoleEnum::VOLUNTEER->value,
            'web'
        );

        $volunteer->syncPermissions([]);
    }
}
