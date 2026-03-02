<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublikasiResource\Pages;
use App\Filament\Resources\PublikasiResource\RelationManagers;
use App\Models\Publikasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PublikasiResource extends Resource
{
    protected static ?string $model = Publikasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Publikasi')
                ->schema([
                    Forms\Components\TextInput::make('judul')->required(),
                    Forms\Components\Select::make('kategori')
                        ->options([
                            'Infografis' => 'Infografis',
                            'Ekonomi' => 'Ekonomi',
                            'Potensi' => 'Potensi',
                        ])->required(),
                    Forms\Components\TextInput::make('tahun')
                        ->numeric()
                        ->required(),
                    Forms\Components\DatePicker::make('tanggal_publikasi')
                        ->label('Tanggal Terbit (Untuk Urutan)')
                        ->required(),
                    Forms\Components\FileUpload::make('file_pdf')
                        ->label('Upload PDF')
                        ->directory('publikasi/pdf')
                        ->acceptedFileTypes(['application/pdf'])
                        ->required()
                        ->maxSize(51200)
                        ->preserveFilenames(),
                    Forms\Components\FileUpload::make('thumbnail')
                        ->image()
                        ->directory('publikasi/thumbnails')
                        ->label('Thumbnail / Cover PDF'),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Menampilkan Thumbnail (Penting untuk Publikasi!)
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Cover')
                    ->disk('public') // Pastikan disk sesuai
                    ->square(),

                // 2. Menampilkan Judul
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Publikasi')
                    ->searchable() // Agar bisa dicari di admin
                    ->sortable()
                    ->weight('bold'),

                // 3. Menampilkan Kategori dengan Badge
                Tables\Columns\BadgeColumn::make('kategori')
                    ->label('Kategori')
                    ->colors([
                        'success' => 'Infografis',
                        'primary' => 'Ekonomi',
                        'warning' => 'Potensi',
                    ]),

                // 4. Menampilkan Tahun
                Tables\Columns\TextColumn::make('tahun')
                    ->label('Tahun')
                    ->sortable(),

                // 5. Menampilkan Tanggal Input
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tambahkan filter tahun agar admin mudah mencari
                Tables\Filters\SelectFilter::make('tahun')
                    ->options([
                        '2024' => '2024',
                        '2025' => '2025',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPublikasis::route('/'),
            'create' => Pages\CreatePublikasi::route('/create'),
            'edit' => Pages\EditPublikasi::route('/{record}/edit'),
        ];
    }
}
