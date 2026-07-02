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
        Schema::create('notifications', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('title');

            $table->text('message');

            $table->string('category')->default('general');

            $table->string('type')->default('announcement');

            $table->enum('audience', [
                'all',
                'member',
                'admin',
            ])->default('member');

            $table->string('link')
                ->nullable();

            $table->enum('priority', [
                'low',
                'normal',
                'high',
                'urgent',
            ])->default('normal');

            $table->boolean('is_pinned')
                ->default(false);

            $table->boolean('is_active')
                ->default(true);

            $table->timestamp('published_at')
                ->nullable();

            $table->timestamp('expires_at')
                ->nullable();

            $table->timestamp('read_at')
                ->nullable();

            $table->string('attachment', 500)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
