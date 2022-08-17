<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    use HasFactory;
    protected $table = 'komplains';
    protected $primaryKey = 'id_komplain';
    protected $fillable = [
        'id_komplain',
        'id_pengguna',
        'alamat',
        'berkas',
        'foto',
        'isi',
        'kategori',
        'no_komplain',
        'tanggal',
        'status'
    ];
}
