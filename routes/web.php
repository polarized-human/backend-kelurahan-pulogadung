<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/perbaiki-gambar', function () {
    Artisan::call('storage:unlink'); // Hapus jembatan lama yang rusak (jika ada)
    Artisan::call('storage:link');   // Buat jembatan baru yang segar
    return 'Jembatan gambar berhasil diperbaiki!';
});