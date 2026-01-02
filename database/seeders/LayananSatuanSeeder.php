<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;
use App\Models\JenisSatuan;

class LayananSatuanSeeder extends Seeder
{
    public function run(): void
    {
        $layanans = [
            ['ID_LAYANAN' => 'L001', 'NAMA_LAYANAN' => 'Cuci Kering', 'HARGA' => 10000],
            ['ID_LAYANAN' => 'L002', 'NAMA_LAYANAN' => 'Cuci Basah', 'HARGA' => 8000],
            ['ID_LAYANAN' => 'L003', 'NAMA_LAYANAN' => 'Setrika', 'HARGA' => 5000],
        ];

        foreach ($layanans as $l) {
            Layanan::updateOrCreate(['ID_LAYANAN' => $l['ID_LAYANAN']], $l);
        }

        $satuans = [
            ['ID_SATUAN' => 'S001', 'JENIS_SATUAN' => 'Kemeja', 'HARGA' => 3000],
            ['ID_SATUAN' => 'S002', 'JENIS_SATUAN' => 'Celana', 'HARGA' => 4000],
            ['ID_SATUAN' => 'S003', 'JENIS_SATUAN' => 'Sepatu', 'HARGA' => 6000],
        ];

        foreach ($satuans as $s) {
            JenisSatuan::updateOrCreate(['ID_SATUAN' => $s['ID_SATUAN']], $s);
        }
    }
}
