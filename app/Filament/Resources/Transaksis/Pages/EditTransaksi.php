<?php
namespace App\Filament\Resources\Transaksis\Pages;

use App\Filament\Resources\Transaksis\TransaksiResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\Pesanan;

class EditTransaksi extends EditRecord
{
    protected static string $resource = TransaksiResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $pesanan = Pesanan::find($data['ID_PESANAN']);
        $subTotalSatuan = $pesanan ? $pesanan->satuan()->sum('SUB_TOTAL') : 0;
        $subTotalLayanan = $pesanan ? $pesanan->layanan()->sum('SUB_TOTAL') : 0;
        $data['TOTAL_BIAYA'] = $subTotalSatuan + $subTotalLayanan;
        return $data;
    }
}