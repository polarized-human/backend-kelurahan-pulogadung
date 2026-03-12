<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatistikResource\Pages;
use App\Filament\Resources\StatistikResource\RelationManagers;
use App\Models\Statistik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatistikResource extends Resource
{
    protected static ?string $model = Statistik::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralModelLabel = 'Statistik';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Pengaturan Grafik')
                ->schema([
                    Forms\Components\Select::make('kategori')
                        ->options([
                            'Kependudukan' => 'Kependudukan',
                            'Ekonomi' => 'Ekonomi',
                            'Kesehatan' => 'Kesehatan',
                            'Pendidikan' => 'Pendidikan',
                        ])->required(),
                    Forms\Components\Select::make('tahun')
                        ->options([
                            '2024' => '2024',
                            '2025' => '2025',
                        ])->required(),
                    Forms\Components\Select::make('semester')
                        ->options([
                            'Semester 1' => 'Semester 1',
                            'Semester 2' => 'Semester 2',
                        ])->required(),
                ])->columns(3),

            // Ini bagian ajaibnya, kamu bisa menambah data grafik tanpa batas
            Forms\Components\Section::make('Data Grafik')
                ->schema([
                    Forms\Components\Repeater::make('chart_data')
                        ->label('Isi Data (Dari Bawah ke Atas)')
                        ->schema([
                            Forms\Components\TextInput::make('label')
                                ->label('Label Y-Axis (Misal: 0-4, 5-9)')
                                ->required(),
                            Forms\Components\TextInput::make('nilai_kiri')
                                ->label('Nilai Kiri / Laki-laki (Biru)')
                                ->numeric()
                                ->required(),
                            Forms\Components\TextInput::make('nilai_kanan')
                                ->label('Nilai Kanan / Perempuan (Merah muda)')
                                ->numeric()
                                ->required(),
                        ])
                        ->columns(3)
                        ->reorderable() // Bisa geser-geser urutan
                        ->collapsible(),
                ])
        ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('kategori')
                    ->colors([
                        'success' => 'Kependudukan',
                        'primary' => 'Ekonomi',
                        'warning' => 'Kesehatan',
                        'danger' => 'Pendidikan',
                    ]),
                Tables\Columns\TextColumn::make('tahun')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('semester')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Filter agar kamu gampang nyari data
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'Kependudukan' => 'Kependudukan',
                        'Ekonomi' => 'Ekonomi',
                        'Kesehatan' => 'Kesehatan',
                        'Pendidikan' => 'Pendidikan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListStatistiks::route('/'),
            'create' => Pages\CreateStatistik::route('/create'),
            'edit' => Pages\EditStatistik::route('/{record}/edit'),
        ];
    }
}
