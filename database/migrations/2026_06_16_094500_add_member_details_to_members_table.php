<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {

            $table->string('membership_id')
                ->nullable()
                ->unique()
                ->after('user_id');

            $table->string('next_of_kin_name')
                ->nullable()
                ->after('membership_status');

            $table->string('next_of_kin_relationship')
                ->nullable()
                ->after('next_of_kin_name');

            $table->string('next_of_kin_phone')
                ->nullable()
                ->after('next_of_kin_relationship');

            $table->text('next_of_kin_address')
                ->nullable()
                ->after('next_of_kin_phone');

            $table->string('band_name')
                ->nullable()
                ->after('next_of_kin_address');

        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {

            $table->dropColumn([
                'membership_id',
                'next_of_kin_name',
                'next_of_kin_relationship',
                'next_of_kin_phone',
                'next_of_kin_address',
                'band_name',
            ]);

        });
    }
};
