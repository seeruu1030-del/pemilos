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
        Schema::table('candidate_mappings', function (Blueprint $table) {
            $table->unsignedInteger('votes_count')->default(0)->after('photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_mappings', function (Blueprint $table) {
            $table->dropColumn('votes_count');
        });
    }
};
