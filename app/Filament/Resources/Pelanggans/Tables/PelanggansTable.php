<?php

namespace App\Filament\Resources\Pelanggans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PelanggansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID_PELANGGAN')->label('ID')->searchable(),
                TextColumn::make('NAMA_PELANGGAN')->label('Nama')->searchable(),
                TextColumn::make('ALAMAT')->label('Alamat')->limit(50)->searchable(),
                TextColumn::make('NO_TELP')->label('No. Telp')->searchable(),
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
