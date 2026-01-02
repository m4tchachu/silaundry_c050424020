<?php

namespace App\Filament\Resources\Pesanans\Pages;

use App\Filament\Resources\Pesanans\PesananResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePesanan extends CreateRecord
{
    protected static string $resource = PesananResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $computed = \App\Models\Pesanan::computeTotalsFromData($data);
        $data['TOTAL_BIAYA'] = $computed['TOTAL_BIAYA'];
        $data['JUMLAH_ITEM'] = $computed['JUMLAH_ITEM'];

        return $data;
    }
}
