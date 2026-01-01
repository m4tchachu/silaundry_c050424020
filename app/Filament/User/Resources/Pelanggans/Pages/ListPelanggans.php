<?php

namespace App\Filament\User\Resources\Pelanggans\Pages;

use App\Filament\User\Resources\Pelanggans\PelangganResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPelanggans extends ListRecords
{
    protected static string $resource = PelangganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
