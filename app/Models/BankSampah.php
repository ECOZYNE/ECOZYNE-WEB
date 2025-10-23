<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankSampah extends Model
{
    use HasFactory;

    protected $table = 'bank_sampah';
    protected $primaryKey = 'id_bank_sampah';

    protected $fillable = [
        'id_pengajuan_bank_sampah',
    ];

    /**
     * Relasi ke Pengajuan Bank Sampah (Belongs To)
     */
    public function pengajuanBankSampah(): BelongsTo
    {
        return $this->belongsTo(PengajuanBankSampah::class, 'id_pengajuan_bank_sampah');
    }

    public function jamOperasional()
    {
        return $this->hasMany(JamOperasional::class, 'id_bank_sampah');
    }

    /** Helper untuk nama bank sampah */
    public function getNamaBankSampahAttribute()
    {
        return $this->pengajuanBankSampah->nama_bank_sampah ?? null;
    }

    /** Helper untuk alamat */
    public function getAlamatAttribute()
    {
        return $this->pengajuanBankSampah->lokasi_bank_sampah ?? null;
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'id_alamat', 'id_alamat');
    }

    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_bank_sampah', 'id_bank_sampah');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_bank_sampah', 'id_bank_sampah');
    }
}
