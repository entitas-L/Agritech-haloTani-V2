<?php

namespace App\Filament\Widgets;

use App\Models\Keluhan;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestKeluhanTable extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Urutkan berdasarkan kolom 'tanggal' (atau 'id_keluhan' jika 'tanggal' bukan datetime)
                Keluhan::query()->latest('tanggal')->limit(5)
            )
            ->heading('Keluhan & Analisis Terbaru')
            ->columns([
                Tables\Columns\TextColumn::make('teks_keluhan')
                    ->label('Judul / Deskripsi')
                    ->limit(40)
                    ->searchable(),

                Tables\Columns\TextColumn::make('jenis_tanaman')
                    ->label('Tanaman')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('urgensi')
                    ->label('Urgensi')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Tinggi' => 'danger',
                        'Sedang' => 'warning',
                        'Rendah' => 'info',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Selesai' => 'success',
                        'Proses' => 'warning',
                        default => 'gray',
                    }),
            ]);
    }
}