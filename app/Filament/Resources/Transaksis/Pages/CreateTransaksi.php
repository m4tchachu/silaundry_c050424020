<?php
namespace App\Filament\Resources\Transaksis\Pages;

use App\Filament\Resources\Transaksis\TransaksiResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Pesanan;
use Illuminate\Support\Str;

class CreateTransaksi extends CreateRecord
{
    protected static string $resource = TransaksiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $pesanan = Pesanan::find($data['ID_PESANAN']);
        $subTotalSatuan = $pesanan ? $pesanan->satuan()->sum('SUB_TOTAL') : 0;
        $subTotalLayanan = $pesanan ? $pesanan->layanan()->sum('SUB_TOTAL') : 0;
        $data['TOTAL_BIAYA'] = $subTotalSatuan + $subTotalLayanan;
        $data['ID_TRANSAKSI'] = Str::random(8);
        return $data;
    }
}