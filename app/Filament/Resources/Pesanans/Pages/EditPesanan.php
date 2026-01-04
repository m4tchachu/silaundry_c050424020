<?php

namespace App\Filament\Resources\Pesanans\Pages;

use App\Filament\Resources\Pesanans\PesananResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Models\PesananSatuan;
use App\Models\PesananLayanan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class EditPesanan extends EditRecord
{
    protected static string $resource = PesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        $satuans = $data['SATUANS'] ?? [];
        $layanans = $data['LAYANANS'] ?? [];

        // Use transaction so update + sync are atomic
        return DB::transaction(function () use ($record, $data, $satuans, $layanans) {
            // Log incoming payload for debugging
            Log::debug('EditPesanan incoming data', ['id' => $record->getKey(), 'data' => $data, 'satuans' => $satuans, 'layanans' => $layanans]);

            unset($data['SATUANS'], $data['LAYANANS']);

            $record = parent::handleRecordUpdate($record, $data);

            // Sync satuans: delete existing and recreate (simple approach)
            $record->satuan()->delete();
            if (is_array($satuans) && count($satuans) > 0) {
                $items = [];
                foreach ($satuans as $item) {
                    $id = $item['ID_SATUAN'] ?? null;
                    if (empty($id)) {
                        continue; // skip empty entries
                    }
                    $items[] = [
                        'ID_SATUAN' => $id,
                        'JUMLAH_ITEM' => $item['JUMLAH_ITEM'] ?? 0,
                        'SUB_TOTAL' => $item['SUB_TOTAL'] ?? 0,
                    ];
                }
                if (count($items) > 0) {
                    $record->satuan()->createMany($items);
                }
            }

            // Sync layanans
            $record->layanan()->delete();
            if (is_array($layanans) && count($layanans) > 0) {
                $items = [];
                foreach ($layanans as $item) {
                    $id = $item['ID_LAYANAN'] ?? null;
                    if (empty($id)) {
                        continue; // skip empty entries
                    }
                    $items[] = [
                        'ID_LAYANAN' => $id,
                        'JUMLAH_ITEM' => $item['JUMLAH_ITEM'] ?? 0,
                        'BERAT' => $item['BERAT'] ?? 0,
                        'SUB_TOTAL' => $item['SUB_TOTAL'] ?? 0,
                    ];
                }
                if (count($items) > 0) {
                    $record->layanan()->createMany($items);
                }
            }

            return $record;
        });
    }
}
