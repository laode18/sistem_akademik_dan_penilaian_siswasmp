<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    public $table = "orang_tua";
    protected $primaryKey = 'id_ortu';
    public $timestamps = false;
   

    protected $fillable = [
        'id_ortu', 'id_siswa', 'nama_ortu', 'alamat', 'username', 'password'
    ];
}

