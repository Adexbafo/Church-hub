<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->renameColumn('title', 'expense_title');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->string('payment_method')
                ->nullable()
                ->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->renameColumn('expense_title', 'title');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->string('category')
                ->nullable();
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });
    }
};
