<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matpel extends Model
{
    public $table = "mata_pelajaran";
    protected $primaryKey = 'id_matpel';
    public $timestamps = false;
   

    protected $fillable = [
        'id_matpel', 'nama_matpel',
    ];
}

