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
        Schema::create('candidate_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('organization_type'); // OSIS or MPK
            $table->integer('paslon_number');
            $table->foreignId('chairman_id')->nullable()->constrained('candidates')->nullOnDelete();
            $table->foreignId('vice_chairman_id')->nullable()->constrained('candidates')->nullOnDelete();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_mappings');
    }
};
