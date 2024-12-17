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
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN supervisor VARCHAR(255) AFTER `status`');
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN `address` VARCHAR(255) AFTER regional_code');
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN phone VARCHAR(255) AFTER `address`');
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN logo VARCHAR(255) AFTER supervisor');
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN invoice_layout VARCHAR(255) AFTER logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assemblies', function (Blueprint $table) {
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN supervisor VARCHAR(255) AFTER updated_at');
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN `address` VARCHAR(255) AFTER supervisor');
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN phone VARCHAR(255) AFTER `address`');
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN logo VARCHAR(255) AFTER phone');
            DB::statement('ALTER TABLE assemblies MODIFY COLUMN invoice_layout VARCHAR(255) AFTER logo');
        });
    }
};
