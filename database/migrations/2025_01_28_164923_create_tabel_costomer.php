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
        Schema::create('metode', function (Blueprint $table) {
            $table->id('id_metode');
            $table->string('nama_metode');
            $table->timestamps();
        });

        Schema::create('costomer', function (Blueprint $table) {
            $table->id('id_costomer');
            $table->foreignId('id_metode')->constrained('metode', 'id_metode')->onDelete('cascade')->nullable();
            $table->string('nama');
            $table->time('waktu');
            $table->date('tanggal');
            $table->enum('selesaikan', ['sudah', 'belum'])->nullable(); 
            $table->decimal('total',10,2)->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costomer');
        Schema::dropIfExists('metode');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('categories');
    }
};
