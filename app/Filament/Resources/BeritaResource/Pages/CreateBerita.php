<?php

namespace App\Filament\Resources\BeritaResource\Pages;

use App\Filament\Resources\BeritaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBerita extends CreateRecord
{
    protected static string $resource = BeritaResource::class;

    // Tambahkan blok kode di bawah ini
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}