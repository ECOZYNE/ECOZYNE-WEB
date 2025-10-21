<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamOperasional extends Model
{
    protected $table = 'jam_operasional'; // ✅ tulis sesuai nama tabel sebenarnya

    protected $primaryKey = 'id_operasional';

    protected $fillable = [
        'id_bank_sampah',
        'hari',
        'jam_buka',
        'jam_tutup',
        'is_tutup',
    ];

    public $timestamps = true;

    public function bankSampah()
    {
        return $this->belongsTo(BankSampah::class, 'id_bank_sampah');
    }
    public function pengajuan()
    {
        return $this->belongsTo(PengajuanBankSampah::class, 'id_pengajuan_bank_sampah');
    }
}
