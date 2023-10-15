<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    public $table = "nilai";
    protected $primaryKey = 'id_nilai';
    public $timestamps = false;
   

    protected $fillable = [
        'id_nilai', 'ulangan_harian', 'ulangan_harian1', 'ulangan_harian2', 'ulangan_harian3', 'uts', 'uas', 'tugas', 'tugas1', 'nilai_absen', 'deskripsi', 'id_bel', 'id_siswa'
    ];
}

