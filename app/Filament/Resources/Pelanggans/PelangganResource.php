<?php

namespace App\Filament\Resources\Pelanggans;

use App\Filament\Resources\Pelanggans\Pages\CreatePelanggan;
use App\Filament\Resources\Pelanggans\Pages\EditPelanggan;
use App\Filament\Resources\Pelanggans\Pages\ListPelanggans;
use App\Filament\Resources\Pelanggans\Schemas\PelangganForm;
use App\Filament\Resources\Pelanggans\Tables\PelanggansTable;
use App\Models\Pelanggan;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PelangganResource extends Resource
{
    protected static ?string $model = Pelanggan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Admin';

    public static function form(Schema $schema): Schema
    {
        return PelangganForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PelanggansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPelanggans::route('/'),
            'create' => CreatePelanggan::route('/create'),
            'edit' => EditPelanggan::route('/{record}/edit'),
        ];
    }

    protected static function userIsAdmin(): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        if (method_exists($user, 'hasRole')) {
            return $user->hasRole('admin');
        }

        if (property_exists($user, 'role')) {
            return strtolower($user->role) === 'admin';
        }

        return false;
    }

    public static function canViewAny(): bool
    {
        return static::userIsAdmin();
    }

    public static function canCreate(): bool
    {
        return static::userIsAdmin();
    }

    public static function canEdit($record): bool
    {
        return static::userIsAdmin();
    }

    public static function canDelete($record): bool
    {
        return static::userIsAdmin();
    }
}
