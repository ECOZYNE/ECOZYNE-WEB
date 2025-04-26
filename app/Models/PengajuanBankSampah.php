<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];
}
