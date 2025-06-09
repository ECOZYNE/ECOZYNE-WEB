<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_sampah extends Model
{
    use HasFactory;

    protected $table = 'transaksi_sampah';
    protected $primaryKey = 'id_transaksi_sampah';
    
    protected $fillable = [
        'id_komunitas',
        'id_bank_sampah', 
        'berat_sampah',
        'poin_didapat',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
        'berat_sampah' => 'decimal:2',
        'poin_didapat' => 'integer'
    ];

    // Relationship dengan komunitas penyetor
    public function komunitas_penyetor()
    {
        return $this->belongsTo(Komunitas::class, 'id_komunitas', 'id_komunitas');
    }

    // Relationship dengan komunitas penerima (bank sampah)
    public function komunitas_penerima()
    {
        return $this->belongsTo(Komunitas::class, 'id_komunitas', 'id_komunitas');
    }

    // Accessor untuk format tanggal
    public function getFormattedDateAttribute()
    {
        return $this->tanggal_transaksi->format('d/m/Y H:i');
    }

    // Accessor untuk format berat
    public function getFormattedWeightAttribute()
    {
        return number_format($this->berat_sampah, 1) . ' kg';
    }

    // Accessor untuk format poin
    public function getFormattedPointsAttribute()
    {
        return number_format($this->poin_didapat) . ' poin';
    }
}