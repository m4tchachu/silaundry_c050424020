<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Pesanan;
use App\Models\Transaksi;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pesanan', Pesanan::count())
                ->description('Total pesanan masuk')
                ->color('primary')
                ->icon('heroicon-o-clipboard-document-list'),

            Stat::make('Proses Cuci', Pesanan::where('STATUS', 'proses')->count())
                ->description('Pesanan dalam proses cuci')
                ->color('warning')
                ->icon('heroicon-o-arrow-path'),

            Stat::make('Selesai', Pesanan::where('STATUS', 'selesai')->count())
                ->description('Pesanan selesai')
                ->color('success')
                ->icon('heroicon-o-check-badge'),

            Stat::make('Total Pendapatan', 'Rp ' . number_format(Transaksi::sum('TOTAL_BIAYA'), 0, ',', '.'))
                ->description('Total pendapatan transaksi')
                ->color('purple')
                ->icon('heroicon-o-banknotes'),
        ];
    }
}
