<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi_Sampah extends Model
{
    use HasFactory;

    protected $table = 'transaksi_sampah';
    protected $primaryKey = 'id_transaksi_sampah';
    public $timestamps = true;

    protected $fillable = [
        'id_komunitas',       // Komunitas penyetor
        'id_bank_sampah',     // Penerima (bank sampah)
        'berat_sampah',
        'point_didapat',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'berat_sampah' => 'decimal:2',
        'point_didapat' => 'integer',
    ];

    public function komunitas_penyetor(): BelongsTo
    {
        return $this->belongsTo(Komunitas::class, 'id_komunitas', 'id_komunitas');
    }

    public function bank_sampah_penerima(): BelongsTo
    {
        return $this->belongsTo(BankSampah::class, 'id_bank_sampah', 'id_bank_sampah');
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->created_at ? $this->created_at->format('d/m/Y H:i') : '-';
    }

    public function getFormattedWeightAttribute(): string
    {
        return number_format((float) $this->berat_sampah, 1) . ' kg';
    }

    public function getFormattedPointsAttribute(): string
    {
        return number_format($this->point_didapat) . ' poin';
    }

    public function scopeByBankSampah($query, $id_bank_sampah)
    {
        return $query->where('id_bank_sampah', $id_bank_sampah);
    }

    public function scopeByKomunitasPenyetor($query, $id_komunitas)
    {
        return $query->where('id_komunitas', $id_komunitas);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
