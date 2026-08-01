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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique()->index();
            $table->string('full_name')->index();
            $table->string('birth_place');
            $table->date('birth_date')->index();
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('class_name');
            $table->enum('organization_type', ['OSIS', 'MPK'])->index();
            $table->enum('status', ['pending', 'passed', 'failed'])->default('pending')->index();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
