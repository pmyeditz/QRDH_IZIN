<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // Sesuaikan dengan nama tabel yang benar
    protected $fillable = ['nama'];

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'guru_kelas', 'kelas_id', 'user_id');
    }
}
