<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iscannners extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alasan',
        'mulai_tgl',
        'sampai_tgl',
        'status',
    ];
}
