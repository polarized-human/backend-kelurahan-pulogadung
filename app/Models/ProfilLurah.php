<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilLurah extends Model
{
    protected $fillable = ['nama', 'nip', 'foto', 'tabel_riwayat'];

    protected $casts = [
        'tabel_riwayat' => 'array',
    ];
}