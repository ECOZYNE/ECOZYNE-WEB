<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class point extends Model
{
   
    protected $table = 'point';
    protected $primaryKey = 'id_point';

    protected $fillable = [
        'id_komunitas',
        'point',
        'expired_point',
    ];
}
