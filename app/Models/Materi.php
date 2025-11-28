<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'tb_materi';

    protected $fillable = [
        'kelas_id',
        'urutan',
        'judul_materi',
        'deskripsi_materi',
        'status'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function isiMateri()
    {
        return $this->hasMany(IsiMateri::class, 'materi_id');
    }
}

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        ateri::class, 'materi_id');
    }
}

