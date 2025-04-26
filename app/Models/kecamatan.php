<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $primaryKey ='id_kecamatan';


    protected $fillable = [
        'kecamatan',
    ];
}
