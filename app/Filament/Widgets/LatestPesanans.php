<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Pesanans\PesananResource;
use App\Models\Pesanan;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestPesanans extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    protected static ?string $heading = 'Latest Pesanans';

    public function table(Table $table): Table
    {
        return $table
            ->query(Pesanan::orderByDesc('TANGGAL_MASUK'))
            ->defaultPaginationPageOption(5)
            ->defaultSort('TANGGAL_MASUK', 'desc')
            ->columns([
                TextColumn::make('TANGGAL_MASUK')
                    ->label('Tgl Masuk')
                    ->date()
                    ->sortable(),
                TextColumn::make('ID_PESANAN')
                    ->label('ID Pesanan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pelanggan.NAMA_PELANGGAN')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('STATUS')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 'Selesai',
                        'info' => 'Diambil',
                        'warning' => 'Proses',
                        'info' => 'Pending',
                        'danger' => 'Batal',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst(strtolower($state)))
                    ->sortable(),
                TextColumn::make('transaksi.TOTAL_BIAYA')
                    ->label('Total')
                    ->searchable()
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('open')
                    ->url(fn (Pesanan $record): string => PesananResource::getUrl('edit', ['record' => $record])),
            ]);
    }

    protected function getTableQuery(): Builder
    {
        return Pesanan::orderByDesc('TANGGAL_MASUK')->limit(7);
    }
    protected function getTableHeaderActions(): array
    {
        return [
            Action::make('viewAll')
                ->label('Lihat Semua Pesanan')
                ->url(route('filament.admin.resources.pesanans.index')),
        ];
    }
}
