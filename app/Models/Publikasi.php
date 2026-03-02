<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
        protected $fillable = [
        'judul',
        'kategori',
        'tahun',
        'file_pdf',
        'thumbnail',
        'tanggal_publikasi'
    ];
}
