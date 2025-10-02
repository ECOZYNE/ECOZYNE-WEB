<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'user';
    protected $primaryKey ='id_user';


    protected $fillable = [
        'username',
        'email',
        'password',
        'role', 
    ];

    // User.php
    // public function komunitas(): HasOne
    // {
    //     return $this->hasOne(Komunitas::class, 'id_user', 'id_user');
    // }// App\Models\User.php
public function komunitas()
{
    return $this->hasOne(Komunitas::class, 'id_user', 'id_user');
}




    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

       public function bankSampah()
    {
        return $this->hasOne(BankSampah::class, 'user_id', 'id');
    }

    use HasApiTokens, HasFactory, Notifiable;
}
