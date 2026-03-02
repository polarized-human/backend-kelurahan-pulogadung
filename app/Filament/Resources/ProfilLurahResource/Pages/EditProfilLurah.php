<?php

namespace App\Filament\Resources\ProfilLurahResource\Pages;

use App\Filament\Resources\ProfilLurahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfilLurah extends EditRecord
{
    protected static string $resource = ProfilLurahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
