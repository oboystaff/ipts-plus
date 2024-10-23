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
            $table->decimal('longitude', 10, 7)->nullable()->after('assembly_code'); // Adjust the 'after' clause as needed
            $table->decimal('latitude', 10, 7)->nullable()->after('longitude'); // Adjust the 'after' clause as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
        });
    }
};