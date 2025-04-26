<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi_penukaran extends Model
{
  
    protected $table = 'transaksi_penukaran';
    protected $primaryKey = 'id_transaksi_penukaran';

    protected $fillable = [
        'jumlah',
        'point_satuan',
    ];
}
