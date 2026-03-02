<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Statistik::create([
            'kategori' => 'Kependudukan',
            'tahun' => '2024',
            'semester' => 'Semester 1',
            'chart_data' => [
                ['label' => '0-4', 'nilai_kiri' => 1200, 'nilai_kanan' => 1150],
                ['label' => '05-09', 'nilai_kiri' => 1500, 'nilai_kanan' => 1600],
                ['label' => '20-24', 'nilai_kiri' => 1450, 'nilai_kanan' => 1400],
                ['label' => '30-34', 'nilai_kiri' => 1600, 'nilai_kanan' => 1550],
                ['label' => '40-44', 'nilai_kiri' => 1800, 'nilai_kanan' => 1850],
            ]
        ]);
    }
}
