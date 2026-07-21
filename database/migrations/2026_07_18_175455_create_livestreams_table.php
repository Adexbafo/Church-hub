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
        Schema::create('livestreams', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->enum('platform', [
                'YouTube',
                'Facebook',
                'Zoom',
                'Other',
            ]);

            $table->string('stream_url')->nullable();

            $table->dateTime('scheduled_at');

            $table->enum('status', [
                'scheduled',
                'live',
                'ended',
            ])->default('scheduled');

            $table->text('description')->nullable();

            $table->foreignId('recording_media_item_id')
                ->nullable()
                ->constrained('media_items')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->boolean('is_published')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestreams');
    }
};
