<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        // Ambil semua berita dari yang terbaru
        $data = Berita::latest()->get();

        // Modifikasi URL gambar agar utuh (jika gambarnya ada)
        $data->transform(function ($item) {
            if ($item->gambar) {
                $item->gambar = asset('storage/' . $item->gambar);
            }
            return $item;
        });

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }
}