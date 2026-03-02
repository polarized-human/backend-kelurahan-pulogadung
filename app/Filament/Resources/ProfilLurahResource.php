<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilLurahResource\Pages;
use App\Models\ProfilLurah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProfilLurahResource extends Resource
{
    protected static ?string $model = ProfilLurah::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Profil Lurah';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Biodata Lurah')
                ->schema([
                    Forms\Components\TextInput::make('nama')
                        ->required()
                        ->placeholder('Misal: ARIYANTO, S.I.P., M.SI'),
                    Forms\Components\TextInput::make('nip')
                        ->label('NIP')
                        ->placeholder('Masukkan NIP jika ada'),
                    Forms\Components\FileUpload::make('foto')
                        ->image()
                        ->directory('profil')
                        ->required(),
                ])->columns(2),

            Forms\Components\Section::make('Riwayat & Penghargaan')
                ->schema([
                    Forms\Components\Repeater::make('tabel_riwayat')
                        ->label('Isi Tabel Profil')
                        ->schema([
                            Forms\Components\TextInput::make('nomor')
                                ->label('Nomor / Tahun')
                                ->required(),
                            Forms\Components\TextInput::make('keterangan')
                                ->label('Detail Riwayat / Penghargaan')
                                ->required(),
                        ])
                        ->columns(2)
                        ->reorderable()
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')->square(),
                Tables\Columns\TextColumn::make('nama')->weight('bold'),
                Tables\Columns\TextColumn::make('nip')->label('NIP'),
                Tables\Columns\TextColumn::make('updated_at')->label('Terakhir Update')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProfilLurahs::route('/'),
            'create' => Pages\CreateProfilLurah::route('/create'),
            'edit' => Pages\EditProfilLurah::route('/{record}/edit'),
        ];
    }
}