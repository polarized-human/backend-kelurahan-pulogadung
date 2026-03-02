<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TugasFungsiResource\Pages;
use App\Models\TugasFungsi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TugasFungsiResource extends Resource
{
    protected static ?string $model = TugasFungsi::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Tugas & Fungsi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Tugas Pokok Kelurahan')
                ->schema([
                    Forms\Components\Textarea::make('tugas')
                        ->label('Deskripsi Tugas')
                        ->required()
                        ->rows(4)
                        ->placeholder('Masukkan paragraf tugas pokok kelurahan di sini...'),
                ]),

            Forms\Components\Section::make('Fungsi Kelurahan')
                ->schema([
                    Forms\Components\Repeater::make('fungsi')
                        ->label('Daftar Fungsi')
                        ->schema([
                            Forms\Components\TextInput::make('poin_fungsi')
                                ->label('Poin Fungsi')
                                ->required(),
                        ])
                        ->reorderable()
                        ->addActionLabel('Tambah Fungsi Baru')
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tugas')
                    ->limit(50)
                    ->label('Tugas Pokok'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTugasFungsis::route('/'),
            'create' => Pages\CreateTugasFungsi::route('/create'),
            'edit' => Pages\EditTugasFungsi::route('/{record}/edit'),
        ];
    }
}