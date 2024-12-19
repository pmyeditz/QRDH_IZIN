<?php

namespace App\Models;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Izin extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'alasan',
        'mulai_tgl',
        'sampai_tgl',
        'status',
        'santri_id'
    ];

    protected $table = 'izin'; // Nama tabel harus benar

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }
}
