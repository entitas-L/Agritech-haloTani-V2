<?php

namespace App\Filament\Widgets;

use App\Models\Keluhan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KeluhanStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Keluhan', Keluhan::count())
                ->description('Keseluruhan laporan keluhan')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Telah Selesai', Keluhan::where('status', 'Selesai')->count())
                ->description('Sudah dianalisis AI')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Dalam Proses', Keluhan::where('status', 'Proses')->count())
                ->description('Menunggu balasan AI')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}