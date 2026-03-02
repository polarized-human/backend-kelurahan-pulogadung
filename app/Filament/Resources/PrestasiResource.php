<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiResource\Pages;
use App\Models\Prestasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Prestasi Kelurahan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Penghargaan')
                ->schema([
                    Forms\Components\TextInput::make('tahun')
                        ->required()
                        ->numeric()
                        ->placeholder('Misal: 2023'),
                    Forms\Components\Textarea::make('deskripsi')
                        ->required()
                        ->rows(3)
                        ->placeholder('Misal: Juara 1 Lomba Kelurahan Tingkat Provinsi DKI Jakarta'),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tahun')
                    ->sortable()
                    ->weight('bold')
                    ->badge() // Membuat tahun tampil seperti label/badge
                    ->color('success'),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->searchable()
                    ->limit(50),
            ])
            ->defaultSort('tahun', 'desc') // Otomatis mengurutkan dari tahun terbaru
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrestasis::route('/'),
            'create' => Pages\CreatePrestasi::route('/create'),
            'edit' => Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }
}