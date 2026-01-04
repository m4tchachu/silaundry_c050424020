<?php

namespace App\Filament\Resources\Transaksis;

use App\Filament\Resources\Transaksis\Pages;
use App\Filament\Resources\Transaksis\Schemas\TransaksiForm;
use App\Filament\Resources\Transaksis\Tables\TransaksisTable;
use App\Models\Transaksi;
use App\Models\Pesanan;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;
use BackedEnum;
use Filament\Resources\Resource;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-currency-dollar';
    protected static string|UnitEnum|null $navigationGroup = 'Transaksi';
    protected static ?string $navigationLabel = 'Transaksi';    

    public static function form(Schema $schema): Schema
    {
        return $schema->schema(TransaksiForm::schema());
    }

    public static function table(Table $table): Table
    {
        return TransaksisTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}