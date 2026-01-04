<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Layanan;

class PesananLayanan extends Model
{
    protected $table = 'pesanan_layanan';
    public $incrementing = false;
    protected $primaryKey = 'ID_LAYANAN';
    protected $keyType = 'string';
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

    protected static function booted()
    {
        static::saving(function ($model) {
            // compute SUB_TOTAL from layanan price, jumlah or berat
            $price = 0;
            if (! empty($model->ID_LAYANAN)) {
                $ly = Layanan::find($model->ID_LAYANAN);
                $price = $ly ? (int) $ly->HARGA : 0;
            }
            $jumlah = (int) ($model->JUMLAH_ITEM ?? 0);
            $berat = (float) ($model->BERAT ?? 0);
            $sub = $jumlah > 0 ? $jumlah * $price : (int) ($berat * $price);
            $model->SUB_TOTAL = (string) $sub;
        });
    }
}
