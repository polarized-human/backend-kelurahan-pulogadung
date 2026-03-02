<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TugasFungsi;

class TugasFungsiController extends Controller
{
    public function index()
    {
        // Kita hanya mengambil 1 data terbaru karena ini halaman statis
        $data = TugasFungsi::latest()->first(); 

        if ($data) {
            return response()->json(['success' => true, 'data' => $data]);
        }

        return response()->json(['success' => false, 'message' => 'Data belum tersedia']);
    }
}
