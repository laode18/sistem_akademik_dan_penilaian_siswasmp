<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    public $table = "absensi";
    protected $primaryKey = 'id_absensi';
    public $timestamps = false;
   

    protected $fillable = [
        'id_absensi', 'pertemuan', 'tanggal', 'hadir', 'sakit', 'izin', 'alpa', 'pokok_pembahasan', 'id_bel', 'id_siswa'
    ];
}

