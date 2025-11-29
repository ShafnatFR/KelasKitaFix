<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsiMateri extends Model
{
    use HasFactory;

    protected $table = 'tb_isi_materi';

    protected $fillable = [
        'id_materi',
        'judul',
        'konten',
        'tipe',
        'file_path'
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi');
    }
}
