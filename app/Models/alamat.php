<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alamat extends Model
{
    protected $table = 'alamat';
    protected $primaryKey ='id_alamat';


    protected $fillable = [
        'id_kelurahan',
        'alamat',
        'kode_pos',
    ];
}