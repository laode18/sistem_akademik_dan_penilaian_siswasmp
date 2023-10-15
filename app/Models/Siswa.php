<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    public $table = "db_siswa";
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;
   

    protected $fillable = [
        'id_siswa', 'nisn', 'nama_siswa', 'jenis_kel', 'id_kelas', 'tanggal_lahir', 'foto', 'password'
    ];
}

