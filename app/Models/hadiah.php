<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hadiah extends Model
{

    protected $table = 'hadiah';
    protected $primaryKey ='id_hadiah';


    protected $fillable = [
        'nama',
        'deskripsi',
        'foto',
        'stok',
        'point',
    ];
}
