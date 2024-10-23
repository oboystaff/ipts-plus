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
        Schema::table('citizens', function (Blueprint $table) {
            // Add password column
            $table->string('password')->nullable();

            // Add accesstype column
            $table->string('accesstype')->nullable();

            // Add email column
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizens', function (Blueprint $table) {
            // Drop password column
            $table->dropColumn('password');

            // Drop accesstype column
            $table->dropColumn('accesstype');

            // Drop email column
            $table->dropColumn('email');
        });
    }
};