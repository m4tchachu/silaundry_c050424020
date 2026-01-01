<?php

namespace App\Filament\User\Resources\Pelanggans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PelangganForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ID_PELANGGAN')
                    ->label('ID Pelanggan')
                    ->required()
                    ->maxLength(4),

                TextInput::make('NAMA_PELANGGAN')
                    ->label('Nama')
                    ->maxLength(30),

                TextInput::make('ALAMAT')
                    ->label('Alamat')
                    ->maxLength(70),

                TextInput::make('NO_TELP')
                    ->label('No. Telp')
                    ->maxLength(13),
            ]);
    }
}
