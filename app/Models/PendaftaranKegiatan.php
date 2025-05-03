<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranKegiatan extends Model
{
    protected $table = 'pendaftaran_kegiatan';
    protected $primaryKey = 'id_pendaftaran_kegiatan';

    protected $fillable = [
        'id_komunitas',
        'id_kegiatan',
    ];
}
