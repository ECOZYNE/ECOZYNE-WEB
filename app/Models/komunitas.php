<?php

namespace App\Models;

use App\Models\PengajuanBankSampah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany; // Tambahkan ini

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

    /**
     * Relasi ke user (komunitas dimiliki oleh satu user).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi ke alamat (komunitas berada pada satu alamat).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alamat(): BelongsTo
    {
        return $this->belongsTo(Alamat::class, 'id_alamat', 'id_alamat');
    }

    /**
     * Relasi ke point (satu komunitas memiliki satu data point).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function point(): HasOne
    {
        return $this->hasOne(Point::class, 'id_komunitas', 'id_komunitas');
    }

    /**
     * Relasi ke pengajuan bank sampah (satu komunitas bisa memiliki beberapa pengajuan).
     * Diubah menjadi HasMany karena secara database tidak ada unique constraint pada id_komunitas di tabel pengajuan_bank_sampah.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengajuanBankSampah(): HasMany
    {
        return $this->hasMany(PengajuanBankSampah::class, 'id_komunitas', 'id_komunitas');
    }

    /**
     * Relasi ke pendaftaran kegiatan (satu komunitas bisa mendaftar banyak kegiatan).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pendaftaranKegiatan(): HasMany
    {
        return $this->hasMany(PendaftaranKegiatan::class, 'id_komunitas', 'id_komunitas');
    }

    /**
     * Relasi ke penukaran (satu komunitas bisa melakukan banyak penukaran).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penukaran(): HasMany
    {
        return $this->hasMany(Penukaran::class, 'id_komunitas', 'id_komunitas');
    }

    /**
     * Relasi ke pesanan (satu komunitas bisa membuat banyak pesanan).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_komunitas', 'id_komunitas');
    }

    /**
     * Relasi ke transaksi sampah (satu komunitas bisa memiliki banyak transaksi sampah).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaksiSampah(): HasMany
    {
        return $this->hasMany(Transaksi_Sampah::class, 'id_komunitas', 'id_komunitas');
    }

    
}
