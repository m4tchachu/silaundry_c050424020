<?php

namespace App\Filament\Resources\Pesanans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PesanansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID_PESANAN')
                    ->label('ID Pesanan')
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
                    ->label('Tanggal Masuk')
                    ->date()
                    ->sortable(),
                TextColumn::make('ESTIMASI_SELESAI')
                    ->label('Estimasi Selesai')
                    ->date()
                    ->sortable(),
                TextColumn::make('JUMLAH_ITEM')
                    ->label('Jumlah Item')
                    ->searchable(),
                TextColumn::make('BERAT')
                    ->label('Berat (kg)')
                    ->searchable(),
                TextColumn::make('STATUS')
                    ->label('Status')
                    ->searchable()
                    ->badge()
                    ->colors([
                        'success' => 'Selesai',
                        'info' => 'Diambil',
                        'warning' => 'Proses',
                        'info' => 'Pending',
                        'danger' => 'Batal',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst(strtolower($state))),
                // TextColumn::make('TOTAL_BIAYA')
                //     ->label('Total')
                //     ->searchable(),
                TextColumn::make('CATATAN')
                    ->label('Catatan')
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
