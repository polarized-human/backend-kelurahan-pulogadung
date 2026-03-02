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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori'); 
            $table->string('alamat')->nullable();
            
            // PASTIKAN HANYA ADA SATU BARIS INI:
            $table->text('deskripsi')->nullable(); 
            
            // Jangan lupa tambahkan kolom telepon di sini agar tabelnya lengkap
            $table->string('telepon')->nullable(); 
            
            $table->string('gambar')->nullable();
            $table->string('gmaps_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
