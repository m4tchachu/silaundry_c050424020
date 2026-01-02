<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesananLayanan extends Model
{
    protected $table = 'pesanan_layanan';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ID_PESANAN',
        'ID_LAYANAN',
        'JUMLAH_ITEM',
        'BERAT',
        'SUB_TOTAL',
    ];

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'ID_LAYANAN', 'ID_LAYANAN');
    }

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'ID_PESANAN', 'ID_PESANAN');
    }
}
