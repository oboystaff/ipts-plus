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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type');
            $table->string('digital_address')->nullable();
            $table->string('location')->nullable();
            $table->string('street_name')->nullable();
            $table->string('rated')->nullable();
            $table->string('validated')->nullable();
            $table->string('property_number')->nullable();
            $table->string('ratable_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};