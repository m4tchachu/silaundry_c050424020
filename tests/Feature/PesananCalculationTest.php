<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pesanan;

class PesananCalculationTest extends TestCase
{
    /** @test */
    public function it_computes_total_biaya_and_jumlah_item_from_payload()
    {
        $data = [
            'layanan' => [
                ['ID_LAYANAN' => 'L001', 'JUMLAH_ITEM' => 2, 'SUB_TOTAL' => 20000],
                ['ID_LAYANAN' => 'L002', 'JUMLAH_ITEM' => 1, 'SUB_TOTAL' => 8000],
            ],
            'satuan' => [
                ['ID_SATUAN' => 'S001', 'JUMLAH_ITEM' => 3, 'SUB_TOTAL' => 9000],
            ],
        ];

        $computed = Pesanan::computeTotalsFromData($data);

        $this->assertEquals(37000, $computed['TOTAL_BIAYA']);
        $this->assertEquals(6, $computed['JUMLAH_ITEM']);
    }
}
