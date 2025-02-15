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
        Schema::table('properties', function (Blueprint $table) {
            $table->string('entity_type')->nullable()->change();
            $table->string('division_id')->nullable()->change();
            $table->string('block_id')->nullable()->change();
            $table->string('zone_id')->nullable()->change();
            $table->string('property_use_id')->nullable()->change();
            $table->string('customer_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('entity_type')->nullable(false)->change();
            $table->string('division_id')->nullable(false)->change();
            $table->string('block_id')->nullable(false)->change();
            $table->string('zone_id')->nullable(false)->change();
            $table->string('property_use_id')->nullable(false)->change();
            $table->string('customer_name')->nullable(false)->change();
        });
    }
};
