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
            $table->string('assembly_code')->after('status_of_business');
            $table->string('division_id')->after('assembly_code');
            $table->string('block_id')->after('division_id');
            $table->string('zone_id')->after('block_id');
            $table->string('property_use_id')->after('zone_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('assembly_code');
            $table->dropColumn('division_id');
            $table->dropColumn('block_id');
            $table->dropColumn('zone_id');
            $table->dropColumn('property_use_id');
        });
    }
};
