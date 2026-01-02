<?php

namespace App\Filament\Resources\JenisSatuans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JenisSatuanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ID_SATUAN')
                    ->label('ID Satuan')
                    ->required()
                    ->maxLength(4),

                TextInput::make('JENIS_SATUAN')
                    ->label('Jenis Satuan')
                    ->maxLength(25),

                TextInput::make('HARGA')
                    ->label('Harga')
                    ->maxLength(12),
            ]);
    }
}
