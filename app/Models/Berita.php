<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Berikan izin agar kolom-kolom ini bisa diisi dari form Filament
    protected $fillable = [
        'judul',
        'kategori',
        'gambar',
        'konten',
        'link_eksternal'
    ];
}