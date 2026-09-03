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
        Schema::create('media_teams', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('role', [
                'photographer',
                'videographer',
                'video_editor',
                'audio_engineer',
                'livestream_operator',
                'director',
            ])->index();

            $table->date('joined_at')
                ->nullable()
                ->index();

            $table->boolean('is_active')
                ->default(true)
                ->index();

            $table->text('notes')
                ->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_teams');
    }
};
