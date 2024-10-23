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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_amt_2', 10, 2);
            $table->string('bill_serial');
            $table->string('bill_no');
            $table->date('bill_date');
            $table->date('due_date');
            $table->decimal('arrears', 10, 2);
            $table->decimal('current_amount', 10, 2);
            $table->decimal('amount_due', 10, 2);
            $table->string('account_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};