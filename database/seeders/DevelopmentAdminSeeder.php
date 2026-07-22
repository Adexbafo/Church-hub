<?php

namespace Database\Seeders;

use App\Enums\Role as RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevelopmentAdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('DEV_ADMIN_EMAIL');

        if (! $email) {
            return;
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('DEV_ADMIN_NAME', 'Development Administrator'),
                'password' => Hash::make(env('DEV_ADMIN_PASSWORD')),
                'email_verified_at' => now(),
            ]
        );

        $user->syncRoles([RoleEnum::SUPER_ADMIN->value]);
    }
}
