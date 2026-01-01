<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SiLaundryDashboard extends Page
{
    protected static string $view = 'filament.pages.si-laundry-dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'SiLaundry';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }
}
