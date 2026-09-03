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

            $table->string('title')
                ->index();

            $table->string('speaker')->index();

            $table->string('scripture')->nullable();

            $table->date('sermon_date')->index();

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
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->boolean('is_featured')
                ->default(false)
                ->index();

            $table->boolean('is_published')
                ->default(true)
                ->index();

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
