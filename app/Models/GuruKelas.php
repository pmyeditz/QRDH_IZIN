<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruKelas extends Model
{
    use HasFactory;
    protected $table = 'guru_kelas';
    public $timestamps = false; // Tidak menggunakan kolom timestamps

    protected $fillable = ['user_id', 'kelas_id'];
}
