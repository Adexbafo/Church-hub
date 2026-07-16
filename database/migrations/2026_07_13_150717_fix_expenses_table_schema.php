<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (
            Schema::hasColumn('expenses', 'title') &&
            ! Schema::hasColumn('expenses', 'expense_title')
        ) {
            Schema::table('expenses', function (Blueprint $table) {
                $table->renameColumn('title', 'expense_title');
            });
        }

        if (Schema::hasColumn('expenses', 'category')) {
            Schema::table('expenses', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }

        if (! Schema::hasColumn('expenses', 'payment_method')) {
            Schema::table('expenses', function (Blueprint $table) {
                $table->string('payment_method')
                    ->nullable()
                    ->after('description');
            });
        }
    }

    public function down(): void
    {
        if (
            Schema::hasColumn('expenses', 'expense_title') &&
            ! Schema::hasColumn('expenses', 'title')
        ) {
            Schema::table('expenses', function (Blueprint $table) {
                $table->renameColumn('expense_title', 'title');
            });
        }

        if (! Schema::hasColumn('expenses', 'category')) {
            Schema::table('expenses', function (Blueprint $table) {
                $table->string('category')
                    ->nullable();
            });
        }

        if (Schema::hasColumn('expenses', 'payment_method')) {
            Schema::table('expenses', function (Blueprint $table) {
                $table->dropColumn('payment_method');
            });
        }
    }
};
