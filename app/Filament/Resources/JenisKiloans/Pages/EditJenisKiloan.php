<?php

namespace App\Filament\Resources\JenisKiloans\Pages;

use App\Filament\Resources\JenisKiloans\JenisKiloanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJenisKiloan extends EditRecord
{
    protected static string $resource = JenisKiloanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
