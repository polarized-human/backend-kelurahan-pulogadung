<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index()
    {
        // Ambil semua data, urutkan berdasarkan kolom 'urutan' dari yang terkecil (1, 2, 3...)
        $data = StrukturOrganisasi::orderBy('urutan', 'asc')->get();
        
        // Ubah format foto agar bisa dibaca dari luar
        foreach ($data as $item) {
            $item->foto_url = $item->foto ? asset('storage/' . $item->foto) : null;
        }

        return response()->json(['success' => true, 'data' => $data]);
    }
}