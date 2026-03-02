<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Infografis;
use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data infografis, urutkan dari yang paling baru
        $data = Infografis::latest()->get();

        // 2. Modifikasi sedikit data gambarnya agar menjadi link URL yang utuh
        $data->transform(function ($item) {
            $item->image = asset('storage/' . $item->image);
            return $item;
        });

        // 3. Kirimkan datanya dalam format JSON (format yang dimengerti Next.js)
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Infografis',
            'data'    => $data
        ]);
    }
}