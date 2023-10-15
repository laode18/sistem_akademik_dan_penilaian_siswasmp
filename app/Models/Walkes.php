<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walkes extends Model
{
    public $table = "wali_kelas";
    protected $primaryKey = 'id_walkes';
    public $timestamps = false;
   

    protected $fillable = [
        'id_walkes', 'nuptk', 'nama_walkes', 'jenis_kel', 'id_kelas', 'foto', 'password'
    ];
}

