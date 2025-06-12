<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penukaran extends Model
{
   
    protected $table = 'penukaran';
    protected $primaryKey = 'id_penukaran';

    protected $fillable = [
        'id_komunita',
        'status_penukaran',
    ];

    public function komunitas()
{
    return $this->belongsTo(Komunitas::class, 'id_komunitas');
}

public function hadiah()
{
    return $this->belongsTo(Hadiah::class, 'id_hadiah');
}

public function transaksi()
{
    return $this->hasMany(transaksi_penukaran::class, 'id_penukaran');
}

}
