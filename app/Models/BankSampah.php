<?php

namespace App\Models;

use App\Models\PengajuanBankSampah;
use Illuminate\Database\Eloquent\Model;

class BankSampah extends Model
{
   
    protected $table = 'bank_sampah';
    protected $primaryKey = 'id_bank_sampah';

    public function pengajuanBankSampah()
    {
        return $this->belongsTo(PengajuanBankSampah::class, 'id_pengajuan_bank_sampah', 'id_pengajuan_bank_sampah');
    }

}

