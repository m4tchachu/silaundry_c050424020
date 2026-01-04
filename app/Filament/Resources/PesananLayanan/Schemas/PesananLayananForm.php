<?php
namespace App\Filament\Resources\PesananLayanan\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PesananLayananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('ID_PESANAN')
                ->label('Pesanan')
                ->relationship('pesanan', 'ID_PESANAN')
                ->required()
                ->searchable()
                ->createOptionForm([
                    // Tambahkan field sesuai kebutuhan create pesanan minimal
                    TextInput::make('ID_PESANAN')->required(),
                ]),
            Select::make('ID_LAYANAN')
                ->label('Layanan')
                ->relationship('layanan', 'NAMA_LAYANAN')
                ->required()
                ->searchable()
                ->createOptionForm([
                    TextInput::make('NAMA_LAYANAN')->required(),
                ]),
            TextInput::make('JUMLAH_ITEM')
                ->numeric()
                ->label('Jumlah Item'),
            TextInput::make('BERAT')
                ->numeric()
                ->label('Berat'),
            TextInput::make('SUB_TOTAL')
                ->numeric()
                ->label('Sub Total'),
        ]);
    }
}
