<?php

namespace Database\Seeders;

use App\Enums\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as PermissionModel;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $registrar = app(PermissionRegistrar::class);

        // Clear before seeding
        $registrar->forgetCachedPermissions();

        foreach (Permission::values() as $permission) {
            PermissionModel::findOrCreate($permission, 'web');
        }

        // IMPORTANT: Clear again after creating permissions
        $registrar->forgetCachedPermissions();
    }
}
