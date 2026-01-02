<?php

namespace App\Filament\Resources\JenisSatuans\Pages;

use App\Filament\Resources\JenisSatuans\JenisSatuanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJenisSatuan extends EditRecord
{
    protected static string $resource = JenisSatuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
