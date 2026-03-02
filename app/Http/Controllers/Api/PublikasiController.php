<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Filament\Resources\PublikasiResource\Pages;
use App\Models\Publikasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\PdfToImage\Pdf; // Import library PDF
use Illuminate\Support\Facades\Storage;

class PublikasiController extends Controller
{
    public function index()
    {
        $publikasi = Publikasi::all();

        // Mapping data agar sesuai dengan interface Publikasi di page.tsx
        $mappedData = $publikasi->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->judul, // Mapping ke 'title'
                'year' => (string) $item->tahun, // Mapping ke 'year'
                'category' => $item->kategori, // Mapping ke 'category'
                'image' => $item->thumbnail ? asset('storage/' . $item->thumbnail) : null,
                'date' => $item->tanggal_publikasi, // Untuk sorting date
                'fileUrl' => asset('storage/' . $item->file_pdf), // Mapping ke 'fileUrl'
            ];
        });

        return response()->json($mappedData);
    }
}
