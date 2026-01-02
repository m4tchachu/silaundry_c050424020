<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKiloan extends Model
{
    protected $table = 'jenis_kiloan';
    protected $primaryKey = 'ID_KILOAN';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ID_KILOAN',
        'PAKET_KILOAN',
        'HARGA',
    ];
}
