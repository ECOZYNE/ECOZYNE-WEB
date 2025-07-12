<?php

namespace App\Models;

use App\Models\PengajuanBankSampah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Komunitas extends Model
{
    use HasFactory;

    protected $table = 'komunitas';
    protected $primaryKey = 'id_komunitas';

    protected $fillable = [
        'id_user',
        'id_alamat',
        'nama',
        'no_telp',
        'foto',
    ];

    // Relasi ke user (komunitas dimiliki oleh satu user)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke alamat (komunitas berada pada satu alamat)
    public function alamat(): BelongsTo
    {
        return $this->belongsTo(Alamat::class, 'id_alamat', 'id_alamat');
    }

    // Relasi ke point (satu komunitas memiliki satu data point)
    public function point(): HasOne
    {
        return $this->hasOne(Point::class, 'id_komunitas', 'id_komunitas');
    }

    // Relasi ke pengajuan bank sampah (satu komunitas hanya bisa mengajukan satu kali)
    public function pengajuanBankSampah()
    {
        return $this->hasOne(PengajuanBankSampah::class, 'id_komunitas', 'id_komunitas');
    }
}
