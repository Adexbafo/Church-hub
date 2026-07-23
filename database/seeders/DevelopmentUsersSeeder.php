<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevelopmentUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $verifiedAt = now();

        $superAdminName = config('app.super_admin_name');
        $superAdminEmail = config('app.super_admin_email');
        $developmentPassword = config('app.development_password');

        if (blank($superAdminName)) {
            throw new \RuntimeException(
                'APP_SUPER_ADMIN_NAME is not configured. Please add it to your .env file.'
            );
        }

        if (blank($superAdminEmail)) {
            throw new \RuntimeException(
                'APP_SUPER_ADMIN_EMAIL is not configured. Please add it to your .env file.'
            );
        }

        if (blank($developmentPassword)) {
            throw new \RuntimeException(
                'APP_DEVELOPMENT_PASSWORD is not configured. Please add it to your .env file before running the seeders.'
            );
        }

        $hashedPassword = Hash::make($developmentPassword);


        $users = [
            [
                'name' => $superAdminName,
                'email' => $superAdminEmail,
                'role' => Role::SUPER_ADMIN,
            ],
            [
                'name' => 'Church Administrator',
                'email' => 'churchadmin@churchhub.test',
                'role' => Role::CHURCH_ADMIN,
            ],
            [
                'name' => 'Pastor',
                'email' => 'pastor@churchhub.test',
                'role' => Role::PASTOR,
            ],
            [
                'name' => 'Finance Officer',
                'email' => 'finance@churchhub.test',
                'role' => Role::FINANCE_OFFICER,
            ],
            [
                'name' => 'Media Director',
                'email' => 'media@churchhub.test',
                'role' => Role::MEDIA_DIRECTOR,
            ],
            [
                'name' => 'Member Manager',
                'email' => 'members@churchhub.test',
                'role' => Role::MEMBER_MANAGER,
            ],
            [
                'name' => 'Communications Officer',
                'email' => 'communications@churchhub.test',
                'role' => Role::COMMUNICATIONS_OFFICER,
            ],
            [
                'name' => 'Volunteer',
                'email' => 'volunteer@churchhub.test',
                'role' => Role::VOLUNTEER,
            ],
        ];

        foreach ($users as $developmentUser) {
            $user = User::updateOrCreate(
                [
                    'email' => $developmentUser['email'],
                ],
                [
                    'name' => $developmentUser['name'],
                    'password' => $hashedPassword,
                    'email_verified_at' => $verifiedAt,
                ]
            );

            $user->syncRoles($developmentUser['role']->value);
        }
    }
}
