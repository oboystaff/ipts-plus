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
            $table->dropColumn('nia_number');
            $table->dropColumn('password');
            $table->dropColumn('accesstype');
            $table->dropColumn('email');
            $table->renameColumn('other_name', 'prefix');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizens', function (Blueprint $table) {
            $table->string('nia_number');
            $table->string('password');
            $table->string('accesstype');
            $table->string('email');
            $table->renameColumn('prefix', 'other_name');
        });
    }
};
