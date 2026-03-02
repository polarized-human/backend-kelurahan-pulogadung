<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfografisResource\Pages;
use App\Filament\Resources\InfografisResource\RelationManagers;
use App\Models\Infografis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InfografisResource extends Resource
{
    protected static ?string $model = Infografis::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul Infografis')
                        ->required()
                        ->maxLength(255),
                        
                    Forms\Components\FileUpload::make('image')
                        ->label('Unggah Gambar')
                        ->image()
                        ->directory('infografis') // Gambar akan tersimpan otomatis di folder khusus
                        ->required(),
                        
                    Forms\Components\TextInput::make('year')
                        ->label('Tahun Publikasi')
                        ->required()
                        ->numeric()
                        ->maxLength(4),
                ]);
        }

public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->square(),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Infografis')
                    ->searchable() // Otomatis membuat kolom ini bisa dicari!
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable(),
            ]);
            // ... biarkan sisa kode di bawahnya (filters, actions, bulkActions) apa adanya ...
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
            'index' => Pages\ListInfografis::route('/'),
            'create' => Pages\CreateInfografis::route('/create'),
            'edit' => Pages\EditInfografis::route('/{record}/edit'),
        ];
    }
}
