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

    // Relasi ke pengajuan bank sampah (bank sampah berasal dari pengajuan)
    public function pengajuanBankSampah()
    {
        return $this->belongsTo(PengajuanBankSampah::class, 'id_pengajuan_bank_sampah', 'id_pengajuan_bank_sampah');
    }


    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'id_alamat', 'id_alamat');
    }

    // Relasi ke transaksi sampah (satu bank sampah bisa memiliki banyak transaksi)
    public function transaksi_sampah()
    {
        return $this->hasMany(Transaksi_Sampah::class, 'id_bank_sampah', 'id_bank_sampah');
    }

    // Relasi ke produk (satu bank sampah bisa punya banyak produk)
    public function produks()
    {
        return $this->hasMany(Produk::class, 'id_bank_sampah', 'id_bank_sampah');
    }

    // Relasi ke pesanan (satu bank sampah bisa menerima banyak pesanan)
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_bank_sampah', 'id_bank_sampah');
    }
}
