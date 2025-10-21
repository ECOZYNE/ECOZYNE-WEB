<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function pengajuanBankSampah()
    {
        return $this->belongsTo(PengajuanBankSampah::class, 'id_pengajuan_bank_sampah');
    }

    public function jamOperasional()
    {
        return $this->hasMany(JamOperasional::class, 'id_bank_sampah');
    }


    /**
     * Helper method untuk mengambil nama bank sampah dari pengajuan
     */
    public function getNamaBankSampahAttribute()
    {
        return $this->pengajuan->nama_bank_sampah ?? null;
    }

    /**
     * Helper method untuk mengambil alamat dari pengajuan
     */
    public function getAlamatAttribute()
    {
        return $this->pengajuan->lokasi_bank_sampah ?? null;
    }
}
