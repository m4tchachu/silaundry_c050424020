<?php

namespace App\Filament\Resources\JenisKiloans;

use App\Filament\Resources\JenisKiloans\Pages\CreateJenisKiloan;
use App\Filament\Resources\JenisKiloans\Pages\EditJenisKiloan;
use App\Filament\Resources\JenisKiloans\Pages\ListJenisKiloans;
use App\Filament\Resources\JenisKiloans\Schemas\JenisKiloanForm;
use App\Filament\Resources\JenisKiloans\Tables\JenisKiloansTable;
use App\Models\JenisKiloan;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JenisKiloanResource extends Resource
{
    protected static ?string $model = JenisKiloan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::NumberedList;

    protected static ?string $recordTitleAttribute = 'PAKET_KILOAN';

    protected static string|UnitEnum|null $navigationGroup = 'Admin';

    public static function form(Schema $schema): Schema
    {
        return JenisKiloanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JenisKiloansTable::configure($table);
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
            'index' => ListJenisKiloans::route('/'),
            'create' => CreateJenisKiloan::route('/create'),
            'edit' => EditJenisKiloan::route('/{record}/edit'),
        ];
    }
}
