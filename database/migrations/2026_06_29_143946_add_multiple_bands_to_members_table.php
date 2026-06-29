<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {

            $table->string('band_one')->nullable()->after('band_name');

            $table->string('band_two')->nullable();

            $table->string('band_three')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {

            $table->dropColumn([
                'band_one',
                'band_two',
                'band_three',
            ]);
        });
    }
};
