<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi_penukaran extends Model
{
  
    protected $table = 'transaksi_penukaran';
    protected $primaryKey = 'id_transaksi_penukaran';

    protected $fillable = [
        'id_penukaran',
        'id_hadiah',
        'jumlah',
        'point_satuan',
    ];

    public function penukaran()
{
    return $this->belongsTo(Penukaran::class, 'id_penukaran');
}

public function hadiah()
{
    return $this->belongsTo(Hadiah::class, 'id_hadiah');
}

}
