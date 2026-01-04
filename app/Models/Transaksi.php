<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi';
    protected $primaryKey = 'ID_TRANSAKSI';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'ID_TRANSAKSI',
        'ID_PESANAN',
        'TOTAL_BIAYA',
        'STATUS',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'ID_PESANAN', 'ID_PESANAN');
    }

    // Set total biaya otomatis dari sub_total pesanan satuan dan layanan
    public function setTotalBiayaAttribute($value)
    {
        $pesanan = $this->pesanan;
        if ($pesanan) {
            $subTotalSatuan = $pesanan->satuan()->sum('SUB_TOTAL');
            $subTotalLayanan = $pesanan->layanan()->sum('SUB_TOTAL');
            $this->attributes['TOTAL_BIAYA'] = $subTotalSatuan + $subTotalLayanan;
        } else {
            $this->attributes['TOTAL_BIAYA'] = $value;
        }
    }
}
