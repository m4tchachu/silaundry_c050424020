<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'ID_PELANGGAN';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ID_PELANGGAN',
        'NAMA_PELANGGAN',
        'ALAMAT',
        'NO_TELP',
    ];

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'ID_PELANGGAN', 'ID_PELANGGAN');
    }
}
