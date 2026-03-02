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
            Schema::table('beritas', function (Blueprint $table) {
                // Menambahkan kolom link_eksternal setelah kolom konten
                $table->string('link_eksternal')->nullable()->after('konten'); 
            });
        }

        public function down(): void
        {
            Schema::table('beritas', function (Blueprint $table) {
                $table->dropColumn('link_eksternal');
            });
        }
};
