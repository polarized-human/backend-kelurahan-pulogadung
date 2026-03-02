<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data dari database
        $data = Fasilitas::all();

        // 2. Transformasi data (terutama untuk URL gambar agar bisa dibaca Next.js)
        $data->transform(function ($item) {
            $item->gambar = $item->gambar ? asset('storage/' . $item->gambar) : null;
            return $item;
        });

        // 3. Kirim sebagai JSON
        return response()->json([
            'success' => true,
            'message' => 'Daftar Fasilitas Berhasil Diambil',
            'data' => $data
        ]);
    }
}