<?php

namespace App\Filament\Resources\Pesanans\Pages;

use App\Filament\Resources\Pesanans\PesananResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPesanan extends EditRecord
{
    protected static string $resource = PesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $computed = \App\Models\Pesanan::computeTotalsFromData($data);
        $data['TOTAL_BIAYA'] = $computed['TOTAL_BIAYA'];
        $data['JUMLAH_ITEM'] = $computed['JUMLAH_ITEM'];

        return $data;
    }
}
