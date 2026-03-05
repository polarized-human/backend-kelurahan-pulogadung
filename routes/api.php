<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InfografisController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\FasilitasController;
use App\Http\Controllers\Api\PublikasiController;
use App\Http\Controllers\Api\StatistikController;
use App\Http\Controllers\Api\ProfilController;
use App\Http\Controllers\Api\StrukturController;
use App\Http\Controllers\Api\TugasFungsiController;
use App\Http\Controllers\Api\PrestasiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Jalur ini akan terbuka di: /api/infografis
Route::get('/infografis', [InfografisController::class, 'index']);

// Jalur untuk mengambil data berita
Route::get('/berita', [BeritaController::class, 'index']);

// Tambahkan jalur ini untuk MENYIMPAN berita baru
Route::post('/berita', [BeritaController::class, 'store']);

// Jalur Portal-info
Route::get('/fasilitas', [FasilitasController::class, 'index']);

//Jalur Publikasi
Route::get('/publikasi', [PublikasiController::class, 'index']);

//Jalur Statistik
Route::get('/statistik', [StatistikController::class, 'index']);

//Jalur Profil : profile-lurah
Route::get('/profil-lurah', [ProfilController::class, 'lurah']);

// Struktur Organisasi
Route::get('/struktur-organisasi', [StrukturController::class, 'index']);

// Tugas n fungsi
Route::get('/tugas-fungsi', [TugasFungsiController::class, 'index']);

// Prestasi
Route::get('/prestasi', [PrestasiController::class, 'index']);