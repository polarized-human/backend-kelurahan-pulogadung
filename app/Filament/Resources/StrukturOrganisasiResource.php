<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StrukturOrganisasiResource\Pages;
use App\Models\StrukturOrganisasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StrukturOrganisasiResource extends Resource
{
    protected static ?string $model = StrukturOrganisasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Struktur Organisasi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Pejabat')
                ->schema([
                    Forms\Components\TextInput::make('jabatan')
                        ->required()
                        ->placeholder('Misal: LURAH atau SEKRETARIS KELURAHAN'),
                    Forms\Components\TextInput::make('nama')
                        ->required(),
                    Forms\Components\TextInput::make('nip')
                        ->label('NIP'),
                    Forms\Components\TextInput::make('urutan')
                        ->numeric()
                        ->required()
                        ->default(1)
                        ->helperText('Angka 1 untuk posisi paling atas (Lurah), 2 untuk posisi di bawahnya, dst.'),
                    Forms\Components\FileUpload::make('foto')
                        ->image()
                        ->directory('struktur')
                        ->columnSpanFull(),
                ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')->circular(),
                Tables\Columns\TextColumn::make('jabatan')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('urutan')->sortable(),
            ])
            ->defaultSort('urutan', 'asc') // Otomatis mengurutkan dari angka 1
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStrukturOrganisasis::route('/'),
            'create' => Pages\CreateStrukturOrganisasi::route('/create'),
            'edit' => Pages\EditStrukturOrganisasi::route('/{record}/edit'),
        ];
    }
}