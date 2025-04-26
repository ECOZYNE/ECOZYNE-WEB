<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelurahan extends Model
{
   
    protected $table = 'kelurahan';
    protected $primaryKey ='id_kelurahan';


    protected $fillable = [
        'id_kecamatan',
        'kelurahan',
    ];
}
