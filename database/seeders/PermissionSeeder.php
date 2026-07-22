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
        // Clear Spatie's cached permissions
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (Permission::values() as $permission) {
            PermissionModel::findOrCreate($permission, 'web');
        }
    }
}
