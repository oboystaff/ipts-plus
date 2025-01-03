<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('assemblies', function (Blueprint $table) {
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN status VARCHAR(255) AFTER geo_coordinate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assemblies', function (Blueprint $table) {
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN status VARCHAR(255) AFTER updated_at');
        });
    }
};
