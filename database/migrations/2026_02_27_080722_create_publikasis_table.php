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
        Schema::create('publikasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori'); // Infografis, Ekonomi, Potensi
            $table->string('tahun');    // Digunakan untuk filterYear
            $table->date('tanggal_publikasi'); // Untuk logika sorting newest/oldest
            $table->string('file_pdf');
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publikasis');
    }
};
