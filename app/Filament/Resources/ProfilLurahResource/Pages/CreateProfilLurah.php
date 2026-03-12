<?php

namespace App\Filament\Resources\ProfilLurahResource\Pages;

use App\Filament\Resources\ProfilLurahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfilLurah extends CreateRecord
{
    protected static string $resource = ProfilLurahResource::class;

        protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
