<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_Komplain extends Model
{
    use HasFactory;
    protected $table = 'status__komplains';
    protected $primaryKey = 'id_status_komplain';
    protected $fillable = [
        'id_komplain',
        "nama_pemeroses",
        "pesan",
        "status",
    ];
}
