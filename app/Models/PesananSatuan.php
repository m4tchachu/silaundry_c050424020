<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\JenisSatuan;

class PesananSatuan extends Model
{
    protected $table = 'pesanan_satuan';
    public $incrementing = false;
    protected $primaryKey = 'ID_SATUAN';
    protected $keyType = 'string';
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

    protected static function booted()
    {
        static::saving(function ($model) {
            // compute SUB_TOTAL from jenis satuan price and jumlah
            $price = 0;
            if (! empty($model->ID_SATUAN)) {
                $js = JenisSatuan::find($model->ID_SATUAN);
                $price = $js ? (int) $js->HARGA : 0;
            }
            $jumlah = (int) ($model->JUMLAH_ITEM ?? 0);
            $model->SUB_TOTAL = (string) ($price * $jumlah);
        });
    }
}
