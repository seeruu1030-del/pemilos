<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify role column to include admin-03
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin-01', 'admin-02', 'admin-03') NOT NULL DEFAULT 'admin-01'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin-01', 'admin-02') NOT NULL DEFAULT 'admin-01'");
    }
};
