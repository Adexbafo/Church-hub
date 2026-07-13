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
        Schema::create('donations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('fund_category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('donor_name')
                ->nullable();

            $table->decimal('amount', 15, 2);

            $table->enum('payment_method', [
                'cash',
                'bank_transfer',
                'pos',
                'online',
            ])->nullable();

            $table->string('reference')
                ->nullable();

            $table->string('receipt_number')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->date('donation_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
