<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
  
class LaporansiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $siswas = DB::table('kelas')
            ->get();

        return view('admin.rekapdata.pilihdatasiswa', compact('siswas'));
    }

    public function filter($id_kelas)
    {
        $siswass = DB::table('db_siswa')
            ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('db_siswa.id_kelas', $id_kelas)
            ->get();

        return view('admin.rekapdata.rekapdatasiswa', compact('siswass'));
    }
}