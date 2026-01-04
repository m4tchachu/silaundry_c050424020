<?php

namespace App\Filament\Resources\PesananLayanan;

use App\Filament\Resources\PesananLayanan\Pages;
use App\Filament\Resources\PesananLayanan\Schemas\PesananLayananForm;
use App\Filament\Resources\PesananLayanan\Tables\PesananLayananTable;
use App\Models\PesananLayanan;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PesananLayananResource extends Resource
{
    protected static ?string $model = PesananLayanan::class;
    protected static ?string $navigationLabel = 'Pesanan Layanan';
    protected static string|UnitEnum|null $navigationGroup = 'Transaksi';

    public static function form(Schema $schema): Schema
    {
        return PesananLayananForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PesananLayananTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesananLayanans::route('/'),
            'create' => Pages\CreatePesananLayanan::route('/create'),
            'edit' => Pages\EditPesananLayanan::route('/{record}/edit'),
        ];
    }
}
