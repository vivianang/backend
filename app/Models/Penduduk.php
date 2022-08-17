<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $table = 'penduduks';
    protected $primaryKey = 'id_penduduk';
    protected $fillable = [
        'nik',
        "nama_penduduk",
        "jenis_kelamin",
        "tempat_lahir",
        "tanggal_lahir",
        "alamat"
    ];
}
