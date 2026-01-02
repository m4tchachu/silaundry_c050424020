<?php

namespace App\Filament\Resources\JenisSatuans\Pages;

use App\Filament\Resources\JenisSatuans\JenisSatuanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJenisSatuans extends ListRecords
{
    protected static string $resource = JenisSatuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
