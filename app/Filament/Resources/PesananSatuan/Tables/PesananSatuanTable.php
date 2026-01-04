<?php
namespace App\Filament\Resources\PesananSatuan\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PesananSatuanTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID_PESANAN')
                    ->label('ID Pesanan')
                    ->searchable(),
                TextColumn::make('satuan.JENIS_SATUAN')
                    ->label('Jenis Satuan')
                    ->searchable(),
                TextColumn::make('JUMLAH_ITEM')
                    ->label('Jumlah Item'),
                TextColumn::make('SUB_TOTAL')
                    ->label('Sub Total')
                    ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format((int)$state, 0, ',', '.') : 'Rp 0'),
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
