<?php

namespace App\Filament\Resources\PesananSatuan;

use App\Filament\Resources\PesananSatuan\Pages;
use App\Filament\Resources\PesananSatuan\Schemas\PesananSatuanForm;
use App\Filament\Resources\PesananSatuan\Tables\PesananSatuanTable;
use App\Models\PesananSatuan;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PesananSatuanResource extends Resource
{
    protected static ?string $model = PesananSatuan::class;
    protected static ?string $navigationLabel = 'Pesanan Satuan';
    protected static string|UnitEnum|null $navigationGroup = 'Transaksi';

    public static function form(Schema $schema): Schema
    {
        return PesananSatuanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PesananSatuanTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesananSatuans::route('/'),
            'create' => Pages\CreatePesananSatuan::route('/create'),
            'edit' => Pages\EditPesananSatuan::route('/{record}/edit'),
        ];
    }
}
