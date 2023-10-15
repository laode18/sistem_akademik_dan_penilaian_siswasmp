<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
  
class LaporanortuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $siswass = DB::table('kelas')
            ->get();

        return view('admin.rekapdata.pilihdataortu', compact('siswass'));
    }

    public function filter($id_kelas)
    {
        $ortus = DB::table('db_siswa')
            ->join('orang_tua', 'db_siswa.id_siswa', '=', 'orang_tua.id_siswa')
            ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('db_siswa.id_kelas', $id_kelas)
            ->get();

        return view('admin.rekapdata.rekapdataortu', compact('ortus'));
    }
}