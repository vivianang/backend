<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalasanBerita extends Model
{
    use HasFactory;

    protected $table = 'balasans_berita';
    protected $primaryKey = 'id_balasan';
    protected $fillable = [
        'id_berita',
        "id_pengguna",
        "balasan"
    ];
}
