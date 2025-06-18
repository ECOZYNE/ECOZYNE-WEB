<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey ='id_kegiatan';


    protected $fillable = [
        'judul',
        'isi',
        'foto',
        'lokasi',
        'kouta',
        'tanggal_kegiatan',
    ];

    public function pendaftaran()
{
    return $this->hasMany(PendaftaranKegiatan::class, 'id_kegiatan', 'id_kegiatan');
}

}