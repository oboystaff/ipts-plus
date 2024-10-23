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
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('business_owner_id')->after('id')->nullable();
            $table->string('business_class')->after('business_type')->nullable();
            $table->string('digital_address')->after('street_name')->nullable();
            $table->string('house_number')->after('digital_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('business_owner_id');
            $table->dropColumn('business_class');
            $table->dropColumn('digital_address');
            $table->dropColumn('house_number');
        });
    }
};
