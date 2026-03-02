<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FasilitasResource\Pages;
use App\Filament\Resources\FasilitasResource\RelationManagers;
use App\Models\Fasilitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Fasilitas')
                ->schema([
                    Forms\Components\TextInput::make('nama')
                        ->label('Nama Lokasi')
                        ->required(),
                    Forms\Components\Select::make('kategori')
                        ->label('Kategori')
                        ->options([
                            // Pastikan key (kiri) sesuai dengan filter di Next.js
                            'kebudayaan' => 'Kebudayaan',
                            'kesehatan' => 'Kesehatan',
                            'pariwisata' => 'Pariwisata',
                            'pertanian' => 'Pertanian',
                            'transportasi' => 'Transportasi',
                            'pendidikan' => 'Pendidikan',
                            'perekonomian' => 'Perekonomian',
                            'prestasi' => 'Prestasi',
                            'wisata-kuliner' => 'Wisata Kuliner',
                            'tempat-ibadah' => 'Tempat Ibadah',
                            'rptra' => 'RPTRA',
                        ])->required(),
                    Forms\Components\TextInput::make('telepon')
                        ->label('Nomor Telepon'),
                    Forms\Components\Textarea::make('alamat')
                        ->label('Alamat Lengkap')
                        ->required(),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Lokasi')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50),
                Tables\Columns\TextColumn::make('telepon')
                    ->label('Telepon'),
                Tables\Columns\BadgeColumn::make('kategori')
                    ->label('Kategori')
                    ->color('success'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'kesehatan' => 'Kesehatan',
                        'pendidikan' => 'Pendidikan',
                        'rptra' => 'RPTRA',
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFasilitas::route('/'),
            'create' => Pages\CreateFasilitas::route('/create'),
            'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
}
