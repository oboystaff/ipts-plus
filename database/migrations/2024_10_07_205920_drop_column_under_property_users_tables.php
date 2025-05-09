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
        Schema::table('property_users', function (Blueprint $table) {
            $table->dropColumn('assembly_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_users', function (Blueprint $table) {
            $table->string('assembly_code')->after('zone_id');
        });
    }
};
