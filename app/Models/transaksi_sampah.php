<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi_sampah extends Model
{
    protected $table = 'transaksi_sampah';
    protected $primaryKey = 'id_transaksi_sampah';

    protected $fillable = [
        'id_komunitas',
        'id_bank_sampah',
        'berat_sampah',
    ];
}
