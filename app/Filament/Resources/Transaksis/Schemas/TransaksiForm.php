<?php
namespace App\Filament\Resources\Transaksis\Schemas;

use Filament\Forms;

class TransaksiForm
{
    public static function schema(): array
    {
        return [
            Forms\Components\Select::make('ID_PESANAN')
                ->label('Pesanan')
                ->relationship('pesanan', 'ID_PESANAN')
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    $pesanan = \App\Models\Pesanan::find($state);
                    $subTotalSatuan = $pesanan ? $pesanan->satuan()->sum('SUB_TOTAL') : 0;
                    $subTotalLayanan = $pesanan ? $pesanan->layanan()->sum('SUB_TOTAL') : 0;
                    $set('TOTAL_BIAYA', $subTotalSatuan + $subTotalLayanan);
                }),
            Forms\Components\TextInput::make('TOTAL_BIAYA')
                ->label('Total Biaya')
                ->disabled()
                ->dehydrated(),
            Forms\Components\Select::make('STATUS')
                ->label('Status')
                ->options([
                    'pending' => 'Pending',
                    'lunas' => 'Lunas',
                    'batal' => 'Batal',
                ])
                ->required(),
        ];
    }
}
