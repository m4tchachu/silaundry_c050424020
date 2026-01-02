<?php

namespace App\Filament\Resources\Pesanans;

use App\Filament\Resources\Pesanans\Pages\CreatePesanan;
use App\Filament\Resources\Pesanans\Pages\EditPesanan;
use App\Filament\Resources\Pesanans\Pages\ListPesanans;
use App\Filament\Resources\Pesanans\Schemas\PesananForm;
use App\Filament\Resources\Pesanans\Tables\PesanansTable;
use App\Models\Pesanan;
use BackedEnum;
use UnitEnum;
use App\Filament\Resources\Pesanans\RelationManagers\LayananRelationManager;
use App\Filament\Resources\Pesanans\RelationManagers\SatuanRelationManager;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ID_PESANAN';

    protected static string|UnitEnum|null $navigationGroup = 'Transaksi';

    public static function form(Schema $schema): Schema
    {
        return PesananForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PesanansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            LayananRelationManager::class,
            SatuanRelationManager::class,
        ];
    }

    protected static function userIsStaff(): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        if (method_exists($user, 'hasRole')) {
            return $user->hasRole('admin') || $user->hasRole('kasir');
        }

        if (property_exists($user, 'role')) {
            $role = strtolower($user->role);
            return $role === 'admin' || $role === 'kasir';
        }

        return false;
    }

    public static function canViewAny(): bool
    {
        return static::userIsStaff();
    }

    public static function canCreate(): bool
    {
        return static::userIsStaff();
    }

    public static function canEdit($record): bool
    {
        return static::userIsStaff();
    }

    public static function canDelete($record): bool
    {
        return static::userIsStaff();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPesanans::route('/'),
            'create' => CreatePesanan::route('/create'),
            'edit' => EditPesanan::route('/{record}/edit'),
        ];
    }
}
