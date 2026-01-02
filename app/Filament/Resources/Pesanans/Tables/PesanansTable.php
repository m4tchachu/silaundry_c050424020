<?php

namespace App\Filament\Resources\Pesanans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PesanansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID_PESANAN')
                    ->searchable(),
                TextColumn::make('pelanggan.NAMA_PELANGGAN')
                    ->label('Pelanggan')
                    ->searchable(),
                TextColumn::make('admin.NAMA_ADMIN')
                    ->label('Admin')
                    ->searchable(),
                TextColumn::make('kurir.NAMA_KURIR')
                    ->label('Kurir')
                    ->searchable(),
                TextColumn::make('jenisKiloan.PAKET_KILOAN')
                    ->label('Kiloan')
                    ->searchable(),
                TextColumn::make('TANGGAL_MASUK')
                    ->date()
                    ->sortable(),
                TextColumn::make('ESTIMASI_SELESAI')
                    ->date()
                    ->sortable(),
                TextColumn::make('JUMLAH_ITEM')
                    ->searchable(),
                TextColumn::make('BERAT')
                    ->searchable(),
                TextColumn::make('STATUS')
                    ->searchable(),
                TextColumn::make('TOTAL_BIAYA')
                    ->searchable(),
                TextColumn::make('CATATAN')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
