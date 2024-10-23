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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('business_type');
            $table->string('location');
            $table->string('email');
            $table->string('street_name');
            $table->string('business_phone');
            $table->string('permit_number');
            $table->string('business_validation_code');
            $table->string('registration_number')->nullable();
            $table->string('business_address');
            $table->string('business_contact')->nullable();
            $table->string('nature_of_business')->nullable();
            $table->string('tax_identification_number')->nullable();
            $table->date('establishment_date')->nullable();
            $table->string('citizen_account_number');
            $table->string('bus_account_number');
            $table->string('status_of_business')->nullable();
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};