<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_bank_sampah',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'foto',
    ];

       protected $casts = [
        'harga' => 'decimal:0',
        'stok' => 'integer'
    ];

    /**
     * Get the bank sampah that owns the produk.
     */
    public function bankSampah()
    {
        return $this->belongsTo(BankSampah::class, 'id_bank_sampah', 'id_bank_sampah');
    }
}