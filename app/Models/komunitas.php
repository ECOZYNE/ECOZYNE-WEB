<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Use BelongsTo
use Illuminate\Database\Eloquent\Relations\HasOne;    // Keep HasOne for Point
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komunitas extends Model
{
    use HasFactory;

    protected $table = 'komunitas'; // Assuming your table name is 'komunitas'
    protected $primaryKey = 'id_komunitas';

    protected $fillable = [
        'id_user',
        'id_alamat',
        'nama',
        'no_telp',
        'foto',
    ];

    /**
     * Get the user that owns the komunitas.
     * This defines the many-to-one relationship where a Komunitas belongs to a User.
     * 'id_user' is the foreign key on the 'komunitas' table, referencing 'id_user' on the 'users' table.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Get the address associated with the komunitas.
     * This defines the many-to-one relationship where a Komunitas belongs to an Alamat.
     * 'id_alamat' is the foreign key on the 'komunitas' table, referencing 'id_alamat' on the 'alamats' table.
     */
    public function alamat(): BelongsTo
    {
        return $this->belongsTo(Alamat::class, 'id_alamat', 'id_alamat');
    }

    /**
     * Get the point record associated with the komunitas.
     * This defines the one-to-one relationship where a Komunitas has one Point record.
     * It assumes 'id_komunitas' is the foreign key in the 'points' table,
     * and 'id_komunitas' is the local key in the 'komunitas' table.
     */
    public function point(): HasOne
    {
        return $this->hasOne(Point::class, 'id_komunitas', 'id_komunitas');
    }


       public function pengajuanBankSampah()
    {
        return $this->hasMany(PengajuanBankSampah::class, 'id_komunitas', 'id_komunitas');
    }
}
