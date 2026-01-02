<?php

namespace App\Filament\Resources\Layanans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LayananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ID_LAYANAN')
                    ->label('ID Layanan')
                    ->required()
                    ->maxLength(8),

                TextInput::make('NAMA_LAYANAN')
                    ->label('Nama Layanan')
                    ->maxLength(20),

                TextInput::make('HARGA')
                    ->label('Harga')
                    ->maxLength(12),
            ]);
    }
}
