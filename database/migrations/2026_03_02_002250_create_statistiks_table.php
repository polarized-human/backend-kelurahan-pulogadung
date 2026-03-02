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
        Schema::create('statistiks', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // Kependudukan, Ekonomi, dll
            $table->string('tahun'); // 2024, 2025
            $table->string('semester'); // Semester 1, Semester 2
            $table->json('chart_data'); // Menyimpan array rentang umur & jumlahnya
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistiks');
    }
};
