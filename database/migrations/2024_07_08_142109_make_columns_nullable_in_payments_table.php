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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('expected_amount_payable')->nullable()->change();
            $table->string('available_discount')->nullable()->change();
            $table->string('mode_of_payment')->nullable()->change();
            $table->string('receipts')->nullable()->change();
            $table->string('GCR_information')->nullable()->change();
            $table->string('notes')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('amount')->nullable()->change();
            $table->string('created_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
};
