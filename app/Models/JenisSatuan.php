<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSatuan extends Model
{
    protected $table = 'jenis_satuan';
    protected $primaryKey = 'ID_SATUAN';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ID_SATUAN',
        'JENIS_SATUAN',
        'HARGA',
    ];
}
