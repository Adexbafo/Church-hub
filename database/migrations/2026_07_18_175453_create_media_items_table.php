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
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('media_category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('media_album_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('title');

            $table->text('description')->nullable();

            $table->string('file_name');

            $table->string('original_name');

            $table->string('file_path');

            $table->string('mime_type');

            $table->enum('media_type', [
                'image',
                'video',
                'audio',
                'document',
            ]);

            $table->unsignedBigInteger('file_size');

            $table->string('thumbnail_path')->nullable();

            $table->foreignId('uploaded_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('views')->default(0);

            $table->unsignedBigInteger('downloads')->default(0);

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
        Schema::dropIfExists('media_items');
    }
};
