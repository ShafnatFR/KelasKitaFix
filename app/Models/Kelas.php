<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'tb_kelas';

    protected $fillable = [
        'mentor_id',
        'nama_kelas',
        'kategori',
        'harga',
        'profil_kelas',
        'deskripsi_kelas',
        'status_publikasi'
    ];

    public function materi()
    {
        return $this->hasMany(Materi::class, 'kelas_id');
    }
}
