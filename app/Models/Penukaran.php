<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penukaran extends Model 
{
    protected $table = 'penukaran';
    protected $primaryKey = 'id_penukaran';

    protected $fillable = [
        'id_komunitas',
        'status_penukaran',
    ];

    public function komunitas() 
    {
        return $this->belongsTo(Komunitas::class, 'id_komunitas');
    }

    public function transaksi() 
    {
        return $this->hasMany(transaksi_penukaran::class, 'id_penukaran');
    }

    public function hadiah() 
    {
        return $this->belongsTo(Hadiah::class, 'id_hadiah');
    }

    /**
     * Menghitung total point yang digunakan untuk penukaran ini
     */
    public function getTotalPointKeluarAttribute()
    {
        return $this->transaksi->collect()->sum(function ($transaksi) {
            return $transaksi->jumlah * $transaksi->point_satuan;
        });
    }

    /**
     * Mendapatkan daftar hadiah yang ditukar dalam format string
     */
    public function getDaftarHadiahAttribute()
    {
        return $this->transaksi->map(function ($transaksi) {
            return ($transaksi->hadiah->nama_hadiah ?? '-') . ' (' . $transaksi->jumlah . 'x)';
        })->implode(', ');
    }
   
}