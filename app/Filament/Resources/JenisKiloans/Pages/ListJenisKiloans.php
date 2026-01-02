<?php

namespace App\Filament\Resources\JenisKiloans\Pages;

use App\Filament\Resources\JenisKiloans\JenisKiloanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJenisKiloans extends ListRecords
{
    protected static string $resource = JenisKiloanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
