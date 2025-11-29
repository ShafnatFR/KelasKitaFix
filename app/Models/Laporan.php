<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'tb_laporan';
    protected $fillable = ['kategori_report', 'keterangan_report', 'status_laporan', 'kelas_id', 'user_id'];
}
