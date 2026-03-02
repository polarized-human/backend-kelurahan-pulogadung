<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProfilLurah;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function lurah()
    {
        // Kita hanya mengambil 1 data terbaru karena Lurah hanya 1 orang
        $data = ProfilLurah::latest()->first(); 
        
        if ($data) {
            // Ubah path foto agar bisa dibaca dari URL
            $data->foto_url = asset('storage/' . $data->foto);
            return response()->json(['success' => true, 'data' => $data]);
        }

        return response()->json(['success' => false, 'message' => 'Data belum tersedia']);
    }
}
