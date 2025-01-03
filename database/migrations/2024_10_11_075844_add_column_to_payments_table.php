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
            $table->dropColumn('amount_paid');
            $table->dropColumn('expected_amount_payable');
            $table->dropColumn('available_discount');
            $table->dropColumn('receipts');
            $table->dropColumn('GCR_information');
            $table->dropColumn('notes');
            $table->string('phone')->after('amount')->nullable();
            $table->string('network')->after('phone')->nullable();
            $table->string('transaction_id')->after('transaction_status');
            $table->text('prompt')->after('network')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('amount_paid');
            $table->string('expected_amount_payable');
            $table->string('available_discount');
            $table->string('receipts');
            $table->string('GCR_information');
            $table->string('notes');
            $table->dropColumn('phone');
            $table->dropColumn('network');
            $table->dropColumn('transaction_id');
            $table->dropColumn('prompt');
        });
    }
};
