<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_komunitas',
        'id_bank_sampah',
        'status_pesanan',
        'status_pembayaran',
    ];

     // Relasi ke Komunitas (pembeli)
    public function komunitas()
    {
        return $this->belongsTo(Komunitas::class, 'id_komunitas', 'id_komunitas');
    }

    // Relasi ke Bank Sampah
    public function bankSampah()
    {
        return $this->belongsTo(BankSampah::class, 'id_bank_sampah', 'id_bank_sampah');
    }

    // Relasi ke transaksi_produk (many-to-many dengan produk)
    public function transaksiProduk()
    {
        return $this->hasMany(transaksi_produk::class, 'id_pesanan', 'id_pesanan');
    }

    // Relasi ke produk melalui transaksi_produk
    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'transaksi_produk', 'id_pesanan', 'id_produk')
                    ->withPivot('jumlah', 'harga')
                    ->withTimestamps();
    }

    
}
