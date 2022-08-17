<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balasan extends Model
{
    use HasFactory;
    protected $table = 'balasans';
    protected $primaryKey = 'id_balasan';
    protected $fillable = [
        'id_komplain',
        "id_pengguna",
        "balasan"
    ];
}
