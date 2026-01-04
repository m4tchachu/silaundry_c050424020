<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Transaksi;

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
        'SUBTOTAL_KILOAN',
        'SUBTOTAL_SATUAN',
        'SUBTOTAL_LAYANAN',
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

    /**
     * Compute total by summing child subtotals and optional kiloan subtotal.
     */
    public function computeTotal(): int
    {
        $satuan = (int) $this->satuan()->sum('SUB_TOTAL');
        $layanan = (int) $this->layanan()->sum('SUB_TOTAL');
        $kiloan = (int) ($this->SUBTOTAL_KILOAN ?? 0);

        return $satuan + $layanan + $kiloan;
    }

    public function getComputedTotalAttribute(): int
    {
        return $this->computeTotal();
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'ID_PESANAN', 'ID_PESANAN');
    }

    /**
     * Sync or create transaksi record for this pesanan using computed total.
     */
    public function syncTransaksi(): void
    {
        $total = $this->computeTotal();
        $transaksiId = 'TR' . strtoupper(substr(uniqid(), -6));

        $transaksi = Transaksi::updateOrCreate(
            ['ID_PESANAN' => $this->ID_PESANAN],
            [
                'ID_TRANSAKSI' => $transaksiId,
                'TOTAL_BIAYA' => $total,
                'STATUS' => 'Pending',
            ]
        );

        // sync rincian: clear and repopulate from child tables
        \App\Models\TransaksiRincian::where('ID_TRANSAKSI', $transaksi->ID_TRANSAKSI)->delete();

        foreach ($this->satuan()->get() as $row) {
            \App\Models\TransaksiRincian::create([
                'ID_TRANSAKSI' => $transaksi->ID_TRANSAKSI,
                'ID_PESANAN' => $this->ID_PESANAN,
                'ITEM_TYPE' => 'satuan',
                'ITEM_ID' => $row->ID_SATUAN,
                'JUMLAH_ITEM' => $row->JUMLAH_ITEM,
                'SUB_TOTAL' => $row->SUB_TOTAL,
            ]);
        }

        foreach ($this->layanan()->get() as $row) {
            \App\Models\TransaksiRincian::create([
                'ID_TRANSAKSI' => $transaksi->ID_TRANSAKSI,
                'ID_PESANAN' => $this->ID_PESANAN,
                'ITEM_TYPE' => 'layanan',
                'ITEM_ID' => $row->ID_LAYANAN,
                'JUMLAH_ITEM' => $row->JUMLAH_ITEM,
                'BERAT' => $row->BERAT,
                'SUB_TOTAL' => $row->SUB_TOTAL,
            ]);
        }
        // persist TOTAL_BIAYA on pesanan without firing model events
        $this->TOTAL_BIAYA = (string) $total;
        if (method_exists($this, 'saveQuietly')) {
            $this->saveQuietly();
        } else {
            static::withoutEvents(function () {
                $this->save();
            });
        }
    }
}
