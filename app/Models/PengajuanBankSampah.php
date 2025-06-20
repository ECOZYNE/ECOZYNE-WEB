<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanBankSampah extends Model
{
    protected $table = 'pengajuan_bank_sampah';
    protected $primaryKey = 'id_pengajuan_bank_sampah';

    protected $fillable = [
        'id_komunitas',
        'nama_bank_sampah',
        'file_dokumen',
        'catatan',
        'status',
        'lokasi_bank_sampah',
        'latitude',
        'longitude',
    ];

    public function komunitas(): BelongsTo
    {
        return $this->belongsTo(Komunitas::class, 'id_komunitas', 'id_komunitas');
    }

  public function bank_sampah()
    {
        return $this->hasOne(BankSampah::class, 'id_pengajuan_bank_sampah', 'id_pengajuan_bank_sampah');
    }
    
}
