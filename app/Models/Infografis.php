<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    use HasFactory;

    // Tambahkan blok kode ini untuk memberikan izin pengisian data
    protected $fillable = [
        'title',
        'image',
        'year',
    ];
}