<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkel extends Model
{
    public $table = "tingkatan_kelas";
    protected $primaryKey = 'id_tingkel';
    public $timestamps = false;
   

    protected $fillable = [
        'id_tingkel', 'nama_tingkel',
    ];
}

