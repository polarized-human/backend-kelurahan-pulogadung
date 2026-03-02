<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncBeritaJakarta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-berita-jakarta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai pengambilan berita...');

        // Contoh mengambil berita dari portal berita (Mock API)
        $response = \Illuminate\Support\Facades\Http::get('https://api.scrapestack.com/berita-jakarta-search?q=pulo+gadung');

        if ($response->successful()) {
            foreach ($response->json()['data'] as $item) {
                \App\Models\Berita::updateOrCreate(
                    ['judul' => $item['judul']], // Mencegah berita duplikat
                    [
                        'slug' => \Illuminate\Support\Str::slug($item['judul']),
                        'konten' => $item['isi'],
                        'tanggal_publikasi' => $item['tanggal'],
                        'gambar' => $item['url_foto'] ?? 'logo.png',
                    ]
                );
            }
            $this->info('Berita berhasil diperbarui secara otomatis!');
        }
    }
}
