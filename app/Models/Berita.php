<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'beritas';
    protected $primaryKey = 'id_berita';
    protected $fillable = [
        'id_admin',
        "isi_berita"
    ];
}
