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
        Schema::create('ablekuma_north_payment_temp', function (Blueprint $table) {
            $table->id();
            $table->integer('SN');
            $table->string('Account');
            $table->string('Address');
            $table->string('OwnerName');
            $table->string('Suburb');
            $table->decimal('RateableV', 15, 2);
            $table->string('Zone');
            $table->string('Use_');
            $table->decimal('Rate', 15, 2);
            $table->decimal('CurrentRate', 15, 2);
            $table->decimal('BasicRate', 15, 2);
            $table->decimal('Arrears', 15, 2);
            $table->decimal('Balance', 15, 2);
            $table->decimal('amount_paid', 15, 2);
            $table->string('paid_by');
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ablekuma_north_payment_temp');
    }
};
