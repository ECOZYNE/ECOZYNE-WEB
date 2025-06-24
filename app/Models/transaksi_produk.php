<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class transaksi_produk extends Model
{
    protected $table = 'transaksi_produk';
    protected $primaryKey = 'id_transaksi_produk';

    protected $fillable = [
        'id_pesanan',
        'id_produk',
        'jumlah',
        'harga', // Ini sekarang berisi total harga (harga_satuan × jumlah)
    ];

    /**
     * Relasi ke Produk.
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    /**
     * Relasi ke Pesanan.
     */
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    /**
     * Get subtotal for this transaction item
     * Karena harga sudah berupa total harga, return langsung
     */
    public function getSubtotalAttribute()
    {
        return $this->harga; // Langsung return harga karena sudah total
    }

    /**
     * Get harga satuan dari produk
     * Jika butuh harga satuan, ambil dari tabel produk
     */
    public function getHargaSatuanAttribute()
    {
        return $this->produk->harga ?? 0;
    }

    /**
     * Alternative: Hitung harga satuan dari total harga / jumlah
     */
    public function getHargaSatuanFromTotalAttribute()
    {
        return $this->jumlah > 0 ? $this->harga / $this->jumlah : 0;
    }
}