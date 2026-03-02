<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    protected $fillable = ['kategori', 'tahun', 'semester', 'chart_data'];

    protected $casts = [
        'chart_data' => 'array', // Penting agar data JSON terbaca sebagai Array
    ];
}