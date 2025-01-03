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
            $table->string('bills_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ablekuma_north_payment_temp', function (Blueprint $table) {
            $table->dropColumn('bills_id');
        });
    }
};
