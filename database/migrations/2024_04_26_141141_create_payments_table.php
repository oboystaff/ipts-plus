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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('bills_id');
            $table->string('amount_paid');
            $table->string('expected_amount_payable');
            $table->string('available_discount');
            $table->string('mode_of_payment');
            $table->string('receipts');
            $table->string('GCR_information');
            $table->string('notes');
            $table->string('status');
            $table->decimal('amount', 10, 2);
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};