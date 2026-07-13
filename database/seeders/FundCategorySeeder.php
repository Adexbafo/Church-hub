<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FundCategory;

class FundCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            [
                'name' => 'Tithe',
                'description' => 'Regular tithes from members.',
            ],

            [
                'name' => 'Offering',
                'description' => 'General church offerings.',
            ],

            [
                'name' => 'Thanksgiving',
                'description' => 'Special thanksgiving offerings.',
            ],

            [
                'name' => 'Building Fund',
                'description' => 'Church building and renovation projects.',
            ],

            [
                'name' => 'Welfare',
                'description' => 'Welfare support and assistance.',
            ],

            [
                'name' => 'Mission',
                'description' => 'Mission and evangelism support.',
            ],

            [
                'name' => 'Special Donation',
                'description' => 'Special contributions and donations.',
            ],

            [
                'name' => 'Youth Fund',
                'description' => 'Youth ministry support.',
            ],

            [
                'name' => 'Women Fellowship',
                'description' => 'Women ministry contributions.',
            ],

            [
                'name' => 'Men Fellowship',
                'description' => 'Men ministry contributions.',
            ],
        ];

        foreach ($categories as $category) {
            FundCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
