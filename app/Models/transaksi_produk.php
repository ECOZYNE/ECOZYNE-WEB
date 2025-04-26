<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi_produk extends Model
{
 
    protected $table = 'transaksi_produk';
    protected $primaryKey = 'id_transaksi_produk';

    protected $fillable = [
        'jumlah',
        'harga_satuan',
    ];
}
