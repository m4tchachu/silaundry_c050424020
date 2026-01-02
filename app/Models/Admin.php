<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'ID_ADMIN';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ID_ADMIN',
        'ID_ROLE',
        'NAMA_ADMIN',
        'USERNAME',
        'PASSWORD',
        'NO_TELP',
        'STATUS',
    ];

    public function role()
    {
        return $this->belongsTo(Peran::class, 'ID_ROLE', 'ID_ROLE');
    }
}
