<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('talent_registrations', function (Blueprint $col) {
            $col->id();
            $col->string('nama_lengkap');
            $col->string('email');
            $col->string('instagram');
            $col->string('no_wa');
            $col->string('asal_univ');
            $col->string('program_study_semester');
            $col->text('keahlian'); // Will store as JSON or comma separated
            $col->string('file_pdf');
            $col->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent_registrations');
    }
};
