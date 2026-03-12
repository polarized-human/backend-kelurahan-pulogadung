<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Filament\Resources\BeritaResource\RelationManagers;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

        protected static ?string $pluralModelLabel = 'Berita';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->label('Judul Berita/Pengumuman')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\Select::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'Berita' => 'Berita Utama',
                        'Pengumuman' => 'Pengumuman Warga',
                        'Kegiatan' => 'Kegiatan Kelurahan',
                    ])
                    ->required(),
                    
                Forms\Components\FileUpload::make('gambar')
                    ->label('Gambar Sampul')
                    ->image()
                    ->directory('berita'),
                    
                // Ini adalah fitur Editor teks canggihnya!
                Forms\Components\RichEditor::make('konten')
                    ->label('Isi Konten')
                    ->required()
                    ->columnSpanFull(), // Agar kotaknya melebar penuh

                // Tambahkan di dalam array schema form kamu:
                Forms\Components\TextInput::make('link_eksternal')
                    ->label('Link Berita Asli (URL Jakarta Timur)')
                    ->url() // Otomatis memvalidasi agar yang dimasukkan harus format link (http/https)
                    ->placeholder('Contoh: https://timur.jakarta.go.id/berita/...')
                    ->columnSpanFull(),
            ]);
    }

public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Sampul'),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50), // Memotong teks jika terlalu panjang
                Tables\Columns\BadgeColumn::make('kategori')
                    ->colors([
                        'primary' => 'Berita',
                        'success' => 'Pengumuman',
                        'warning' => 'Kegiatan',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
            ]);
            // ... (biarkan sisa kode filters/actions di bawahnya)
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
