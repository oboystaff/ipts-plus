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
            $table->string('SN')->nullable()->change();
            $table->string('Account')->nullable()->change();
            $table->string('Address')->nullable()->change();
            $table->string('OwnerName')->nullable()->change();
            $table->string('Suburb')->nullable()->change();
            $table->string('RateableV')->nullable()->change();
            $table->string('Zone')->nullable()->change();
            $table->string('Use_')->nullable()->change();
            $table->string('Rate')->nullable()->change();
            $table->string('CurrentRate')->nullable()->change();
            $table->string('BasicRate')->nullable()->change();
            $table->string('Arrears')->nullable()->change();
            $table->string('Balance')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ablekuma_north_payment_temp', function (Blueprint $table) {
            //
        });
    }
};
