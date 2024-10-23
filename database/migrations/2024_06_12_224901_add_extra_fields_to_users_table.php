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
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('active')->after('remember_token');
            $table->string('access_level')->nullable()->after('status');
            $table->string('assembly_code')->nullable()->after('access_level');
            $table->string('division_code')->nullable()->after('assembly_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('access_level');
            $table->dropColumn('assembly_code');
            $table->dropColumn('division_code');
        });
    }
};