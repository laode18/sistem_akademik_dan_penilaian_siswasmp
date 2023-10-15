<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    public $table = "guru";
    protected $primaryKey = 'id_guru';
    public $timestamps = false;
   

    protected $fillable = [
        'id_guru', 'nuptk', 'nama_guru', 'jenis_kel', 'foto', 'password',
    ];
}

