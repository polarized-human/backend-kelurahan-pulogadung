<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;

class PrestasiController extends Controller
{
    public function index()
    {
        // Ambil semua data prestasi, urutkan dari tahun terbaru ke terlama
        $data = Prestasi::orderBy('tahun', 'desc')->get();

        if ($data->count() > 0) {
            return response()->json(['success' => true, 'data' => $data]);
        }

        return response()->json(['success' => false, 'message' => 'Data belum tersedia']);
    }
}