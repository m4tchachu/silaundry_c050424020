<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'ID_PESANAN';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ID_PESANAN',
        'ID_PELANGGAN',
        'ID_ADMIN',
        'ID_KURIR',
        'ID_KILOAN',
        'TANGGAL_MASUK',
        'ESTIMASI_SELESAI',
        'JUMLAH_ITEM',
        'BERAT',
        'STATUS',
        'TOTAL_BIAYA',
        'CATATAN',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'ID_PELANGGAN', 'ID_PELANGGAN');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'ID_ADMIN', 'ID_ADMIN');
    }

    public function kurir(): BelongsTo
    {
        return $this->belongsTo(Kurir::class, 'ID_KURIR', 'ID_KURIR');
    }

    public function jenisKiloan(): BelongsTo
    {
        return $this->belongsTo(JenisKiloan::class, 'ID_KILOAN', 'ID_KILOAN');
    }

    public function layanan(): HasMany
    {
        return $this->hasMany(PesananLayanan::class, 'ID_PESANAN', 'ID_PESANAN');
    }

    public function satuan(): HasMany
    {
        return $this->hasMany(PesananSatuan::class, 'ID_PESANAN', 'ID_PESANAN');
    }

    public static function computeTotalsFromData(array $data): array
    {
        $totalLayanan = collect($data['layanan'] ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0);
        $totalSatuan = collect($data['satuan'] ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0);

        $totalBiaya = $totalLayanan + $totalSatuan;

        $jumlahItem = collect($data['layanan'] ?? [])->sum(fn($i) => $i['JUMLAH_ITEM'] ?? 0)
            + collect($data['satuan'] ?? [])->sum(fn($i) => $i['JUMLAH_ITEM'] ?? 0);

        return [
            'TOTAL_BIAYA' => $totalBiaya,
            'JUMLAH_ITEM' => $jumlahItem,
        ];
    }
}

