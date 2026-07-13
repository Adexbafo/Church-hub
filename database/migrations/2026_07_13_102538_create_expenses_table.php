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
        Schema::create('expenses', function (Blueprint $table) {

            $table->id();

            $table->foreignId('fund_category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->decimal('amount', 15, 2);

            $table->string('expense_title');

            $table->text('description')
                ->nullable();

            $table->string('payment_method')
                ->nullable();

            $table->string('reference')
                ->nullable();

            $table->date('expense_date');

            $table->foreignId('recorded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
