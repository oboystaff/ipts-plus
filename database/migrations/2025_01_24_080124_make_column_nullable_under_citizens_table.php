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
            $table->string('first_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->string('prefix')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('date_of_birth')->nullable()->change();
            $table->string('telephone_number')->nullable()->change();
            $table->string('country_of_citizenship')->nullable()->change();
            $table->string('customer_type')->nullable()->change();
            $table->string('Ghana_card_number')->nullable()->change();
            $table->string('id_type')->after('Ghana_card_number')->nullable();
            $table->string('id_number')->after('id_type')->nullable();
            $table->string('business_name')->after('id_number')->nullable();
            $table->string('email')->after('business_name')->nullable();
            $table->string('date_of_commencement')->after('email')->nullable();
            $table->text('security_question')->after('date_of_commencement')->nullable();
            $table->text('security_answer')->after('security_question')->nullable();
            $table->string('tin_number')->after('security_answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizens', function (Blueprint $table) {
            $table->string('first_name')->nullable(false)->change();
            $table->string('last_name')->nullable(false)->change();
            $table->string('prefix')->nullable(false)->change();
            $table->string('gender')->nullable(false)->change();
            $table->string('date_of_birth')->nullable(false)->change();
            $table->string('telephone_number')->nullable(false)->change();
            $table->string('country_of_citizenship')->nullable(false)->change();
            $table->string('customer_type')->nullable(false)->change();
            $table->string('Ghana_card_number')->nullable(false)->change();
            $table->dropColumn('id_type');
            $table->dropColumn('id_number');
            $table->dropColumn('business_name');
            $table->dropColumn('email');
            $table->dropColumn('date_of_commencement');
            $table->dropColumn('security_question');
            $table->dropColumn('security_answer');
            $table->dropColumn('tin_number');
        });
    }
};
