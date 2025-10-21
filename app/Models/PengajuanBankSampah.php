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

    public function komunitas()
    {
        return $this->belongsTo(User::class, 'id_komunitas');
    }

    public function bankSampah()
    {
        return $this->hasOne(BankSampah::class, 'id_pengajuan_bank_sampah');
    }


    public function hasBankSampah()
    {
        return $this->bankSampah()->exists();
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk pengajuan yang diterima
     */
    public function scopeDiterima($query)
    {
        return $query->where('status', 'diterima');
    }

    /**
     * Scope untuk pengajuan yang diproses
     */
    public function scopeDiproses($query)
    {
        return $query->where('status', 'diproses');
    }

    /**
     * Scope untuk pengajuan yang ditolak
     */
    public function scopeDitolak($query)
    {
        return $query->where('status', 'ditolak');
    }

    public function jamOperasional()
    {
        return $this->hasMany(JamOperasional::class, 'id_pengajuan_bank_sampah');
    }
}
