<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_bank_sampah',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'foto',
    ];
}
