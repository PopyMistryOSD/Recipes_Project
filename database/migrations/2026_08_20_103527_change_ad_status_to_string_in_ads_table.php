<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE ads MODIFY ad_status VARCHAR(255) DEFAULT 'off'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE ads MODIFY ad_status BOOLEAN DEFAULT 0");
    }
};
