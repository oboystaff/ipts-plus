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
        Schema::create('ablekuma_north_invoice_payments', function (Blueprint $table) {
            $table->id();
            $table->string('bills_id');
            $table->string('amount_paid');
            $table->string('payment_method');
            $table->string('payment_phone_no');
            $table->string('payment_network')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ablekuma_north_invoice_payments');
    }
};
