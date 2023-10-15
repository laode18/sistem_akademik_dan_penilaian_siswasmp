<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelajaran extends Model
{
    public $table = "pembelajaran";
    protected $primaryKey = 'id_bel';
    public $timestamps = false;
   

    protected $fillable = [
        'id_bel', 'id_guru', 'id_matpel', 'id_kelas',
    ];
}

