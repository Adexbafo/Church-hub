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
        Schema::create('sermons', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->string('speaker');

            $table->string('scripture')->nullable();

            $table->date('sermon_date');

            $table->text('description')->nullable();

            $table->foreignId('audio_media_item_id')
                ->nullable()
                ->constrained('media_items')
                ->nullOnDelete();

            $table->foreignId('video_media_item_id')
                ->nullable()
                ->constrained('media_items')
                ->nullOnDelete();

            $table->foreignId('notes_media_item_id')
                ->nullable()
                ->constrained('media_items')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->boolean('is_featured')->default(false);

            $table->boolean('is_published')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sermons');
    }
};
