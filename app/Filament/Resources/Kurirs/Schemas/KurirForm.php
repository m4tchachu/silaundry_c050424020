<?php

namespace App\Filament\Resources\Kurirs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KurirForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ID_KURIR')
                    ->label('ID Kurir')
                    ->required()
                    ->maxLength(4),

                TextInput::make('NAMA_KURIR')
                    ->label('Nama Kurir')
                    ->maxLength(30),

                TextInput::make('NO_TELP')
                    ->label('No. Telp')
                    ->maxLength(13),

                TextInput::make('KENDARAAN')
                    ->label('Kendaraan')
                    ->maxLength(25),
            ]);
    }
}
