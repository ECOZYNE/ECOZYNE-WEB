<?php

namespace App\Models;

use App\Models\PengajuanBankSampah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankSampah extends Model
{
    use HasFactory;

    protected $table = 'bank_sampah';
    protected $primaryKey = 'id_bank_sampah';

    protected $fillable = [
        'id_pengajuan_bank_sampah',
     
    ];

    public function pengajuanBankSampah()
    {
        return $this->belongsTo(PengajuanBankSampah::class, 'id_pengajuan_bank_sampah', 'id_pengajuan_bank_sampah');
    }

    /**
     * Get the address associated with the BankSampah.
     */
    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'id_alamat', 'id_alamat');
    }

    public function transaksi_sampah()
    {
        return $this->hasMany(Transaksi_Sampah::class, 'id_bank_sampah', 'id_bank_sampah');
    }

    /**
     * Get the produks for the Bank Sampah.
     */
    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_bank_sampah', 'id_bank_sampah');
    }
}