<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesananSatuan extends Model
{
    protected $table = 'pesanan_satuan';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ID_PESANAN',
        'ID_SATUAN',
        'JUMLAH_ITEM',
        'SUB_TOTAL',
    ];

    public function satuan(): BelongsTo
    {
        return $this->belongsTo(JenisSatuan::class, 'ID_SATUAN', 'ID_SATUAN');
    }

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'ID_PESANAN', 'ID_PESANAN');
    }
}
