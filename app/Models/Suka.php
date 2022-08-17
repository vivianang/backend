<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suka extends Model
{
    use HasFactory;
    protected $table = 'sukas';
    protected $primaryKey = 'id_suka';
    protected $fillable = [
        'id_komplain',
        "id_pengguna",
    ];
}
