<?php
namespace App\Filament\Resources\PesananSatuan\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PesananSatuanForm
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
                    TextInput::make('ID_PESANAN')->required(),
                ]),
            Select::make('ID_SATUAN')
                ->label('Jenis Satuan')
                ->relationship('satuan', 'JENIS_SATUAN')
                ->required()
                ->searchable()
                ->createOptionForm([
                    TextInput::make('JENIS_SATUAN')->required(),
                ]),
            TextInput::make('JUMLAH_ITEM')
                ->numeric()
                ->label('Jumlah Item'),
            TextInput::make('SUB_TOTAL')
                ->numeric()
                ->label('Sub Total'),
        ]);
    }
}
