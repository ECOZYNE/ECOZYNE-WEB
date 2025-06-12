<?php

namespace App\Models;

use App\Models\PengajuanBankSampah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini jika Anda menggunakan factory

class BankSampah extends Model
{
    use HasFactory; // Tambahkan ini jika Anda menggunakan factory

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
        // Asumsi 'id_alamat' adalah foreign key di tabel 'bank_sampah'
        // dan menunjuk ke 'id_alamat' di tabel 'alamats'
        return $this->belongsTo(Alamat::class, 'id_alamat', 'id_alamat');
    }

       public function transaksi_sampah()
    {
        return $this->hasMany(Transaksi_Sampah::class, 'id_bank_sampah', 'id_bank_sampah');
    }
}