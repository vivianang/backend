<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'penggunas';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'id_penduduk',
        "email",
        "password",
        "no_telpon",
    ];
}
