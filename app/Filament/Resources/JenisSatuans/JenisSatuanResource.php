<?php

namespace App\Filament\Resources\JenisSatuans;

use App\Filament\Resources\JenisSatuans\Pages\CreateJenisSatuan;
use App\Filament\Resources\JenisSatuans\Pages\EditJenisSatuan;
use App\Filament\Resources\JenisSatuans\Pages\ListJenisSatuans;
use App\Filament\Resources\JenisSatuans\Schemas\JenisSatuanForm;
use App\Filament\Resources\JenisSatuans\Tables\JenisSatuansTable;
use App\Models\JenisSatuan;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JenisSatuanResource extends Resource
{
    protected static ?string $model = JenisSatuan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ListBullet;

    protected static ?string $recordTitleAttribute = 'JENIS_SATUAN';

    protected static string|UnitEnum|null $navigationGroup = 'Admin';

    public static function form(Schema $schema): Schema
    {
        return JenisSatuanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JenisSatuansTable::configure($table);
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
            'index' => ListJenisSatuans::route('/'),
            'create' => CreateJenisSatuan::route('/create'),
            'edit' => EditJenisSatuan::route('/{record}/edit'),
        ];
    }
}
