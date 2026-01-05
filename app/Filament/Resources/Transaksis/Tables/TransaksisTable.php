<?php
namespace App\Filament\Resources\Transaksis\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID_PESANAN')
                    ->label('ID Pesanan')
                    ->searchable(),
                TextColumn::make('TOTAL_BIAYA')
                    ->label('Total Biaya')
                    ->searchable(),
                TextColumn::make('STATUS')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 'Lunas',
                        'info' => 'Pending',
                        'danger' => 'Batal',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst(strtolower($state))),
                TextColumn::make('created_at')
                    ->label('Dibuat'),
            ])
            ->filters([
                // Tambahkan filter jika perlu
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
