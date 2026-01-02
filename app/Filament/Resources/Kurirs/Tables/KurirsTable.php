<?php

namespace App\Filament\Resources\Kurirs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KurirsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ID_KURIR')
                    ->searchable(),
                TextColumn::make('NAMA_KURIR')
                    ->searchable(),
                TextColumn::make('NO_TELP')
                    ->searchable(),
                TextColumn::make('KENDARAAN')
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
