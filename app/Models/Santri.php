<?php

namespace App\Models;

use App\Models\Izin;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Santri extends Model
{
    use HasFactory;
    protected $table = 'santris';
    protected $primaryKey = 'idSantri';
    public $timestamps = true;

    protected $fillable = [
        'idSantri',
        'slug',
        'nama',
        'nis',
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'foto',
        'kelas_id'
    ];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }


    public function izins()
    {
        return $this->hasMany(Izin::class);
    }
    public function izin()
    {
        return $this->hasOne(Izin::class, 'santris_id');
    }
}
