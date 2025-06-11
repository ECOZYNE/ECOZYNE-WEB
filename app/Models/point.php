<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Point extends Model
{
    use HasFactory;

    protected $table = 'point';
    protected $primaryKey = 'id_point';

    protected $fillable = [
        'id_komunitas',
        'point',
        'expired_point',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expired_point' => 'datetime', // Cast this attribute to a DateTime object
    ];
}
