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
        Schema::table('zones', function (Blueprint $table) {
            $table->string('assembly_code')->after('name')->nullable();
        });

        Schema::table('property_users', function (Blueprint $table) {
            $table->string('assembly_code')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->dropColumn('assembly_code');
        });

        Schema::table('property_users', function (Blueprint $table) {
            $table->dropColumn('assembly_code');
        });
    }
};
