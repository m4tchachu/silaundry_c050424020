<?php

namespace App\Filament\Resources\JenisKiloans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JenisKiloanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ID_KILOAN')
                    ->label('ID Kiloan')
                    ->required()
                    ->maxLength(6),

                TextInput::make('PAKET_KILOAN')
                    ->label('Paket')
                    ->maxLength(25),

                TextInput::make('HARGA')
                    ->label('Harga')
                    ->maxLength(12),
            ]);
    }
}
