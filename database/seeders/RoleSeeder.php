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
        Role::findOrCreate(RoleEnum::CHURCH_ADMIN->value, 'web');

        /*
         * Pastor
         */
        Role::findOrCreate(RoleEnum::PASTOR->value, 'web');

        /*
         * Finance Officer
         */
        Role::findOrCreate(RoleEnum::FINANCE_OFFICER->value, 'web');

        /*
         * Media Director
         */
        Role::findOrCreate(RoleEnum::MEDIA_DIRECTOR->value, 'web');

        /*
         * Member Manager
         */
        Role::findOrCreate(RoleEnum::MEMBER_MANAGER->value, 'web');

        /*
         * Communications Officer
         */
        Role::findOrCreate(RoleEnum::COMMUNICATIONS_OFFICER->value, 'web');

        /*
         * Volunteer
         */
        Role::findOrCreate(RoleEnum::VOLUNTEER->value, 'web');
    }
}
