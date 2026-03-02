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
            Schema::create('infografis', function (Blueprint $table) {
                $table->id();
                $table->string('title'); // Untuk judul infografis
                $table->string('image'); // Untuk menyimpan nama file gambar
                $table->string('year');  // Untuk tahun data
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infografis');
    }
};
