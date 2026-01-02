<?php

namespace App\Filament\Resources\Kurirs;

use App\Filament\Resources\Kurirs\Pages\CreateKurir;
use App\Filament\Resources\Kurirs\Pages\EditKurir;
use App\Filament\Resources\Kurirs\Pages\ListKurirs;
use App\Filament\Resources\Kurirs\Schemas\KurirForm;
use App\Filament\Resources\Kurirs\Tables\KurirsTable;
use App\Models\Kurir;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KurirResource extends Resource
{
    protected static ?string $model = Kurir::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Truck;
    protected static ?string $navigationLabel = 'Kurir';

    protected static ?string $recordTitleAttribute = 'NAMA_KURIR';

    protected static string|UnitEnum|null $navigationGroup = 'Admin';

    public static function form(Schema $schema): Schema
    {
        return KurirForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KurirsTable::configure($table);
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKurirs::route('/'),
            'create' => CreateKurir::route('/create'),
            'edit' => EditKurir::route('/{record}/edit'),
        ];
    }
}
