<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->text('description')->nullable();

            $table->date('event_date')->index();

            $table->time('start_time');

            $table->time('end_time')->nullable();

            $table->string('venue');

            $table->string('category')->default('general');

            $table->boolean('is_featured')->default(false);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
