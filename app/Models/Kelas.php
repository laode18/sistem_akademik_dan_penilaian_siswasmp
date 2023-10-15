<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    public $table = "kelas";
    protected $primaryKey = 'id_kelas';
    public $timestamps = false;
   

    protected $fillable = [
        'id_kelas', 'nama_kelas',
    ];
}

