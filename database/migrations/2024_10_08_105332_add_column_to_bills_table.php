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
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn('bus_account_number');
            $table->dropColumn('status');
            $table->string('bills_id')->after('id')->change();
            $table->string('assembly_code')->after('property_id');
            $table->string('arrears')->after('bills_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->string('bus_account_number');
            $table->string('status');
            $table->string('bills_id')->after('property_id');
            $table->dropColumn('assembly_code');
            $table->dropColumn('arrears');
        });
    }
};
