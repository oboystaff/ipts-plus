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
        Schema::table('ablekuma_north_payment_temp', function (Blueprint $table) {
            $table->string('status')->default('Pending')->after('payment_method');
            $table->string('transaction_id')->nullable()->after('status');
            $table->text('reason')->nullable()->after('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ablekuma_north_payment_temp', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('transaction_id');
            $table->dropColumn('reason');
        });
    }
};
