<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Statistik;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap permintaan filter dari Next.js
        $kategori = $request->query('kategori', 'Kependudukan');
        $tahun = $request->query('tahun', '2024');
        $semester = $request->query('semester', 'Semester 1');

        // Cari 1 data yang paling cocok
        $data = Statistik::where('kategori', $kategori)
            ->where('tahun', $tahun)
            ->where('semester', $semester)
            ->first();

        if ($data) {
            return response()->json(['success' => true, 'data' => $data]);
        } else {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }
    }
}