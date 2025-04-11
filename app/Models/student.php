<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class student extends Model
{
    use HasFactory;

    protected $table = "students";

    protected $fillable = array(
        "nim", "nama", "email", "prodi" 
    );
}
