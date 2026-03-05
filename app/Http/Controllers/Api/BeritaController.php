<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        $data = $request->only(['judul', 'kategori', 'konten']);

        // 2. Proses upload gambar (jika ada)
        if ($request->hasFile('gambar')) {
            // Gambar akan disimpan di storage/app/public/berita
            $path = $request->file('gambar')->store('berita', 'public');
            $data['gambar'] = $path;
        }

        // 3. Simpan ke database
        $berita = Berita::create($data);

        // 4. Beri jawaban sukses ke Next.js
        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil disimpan!',
            'data' => $berita
        ], 201);
    }
}