<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
  
class LaporanwalkesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $walkes = DB::table('wali_kelas')
            ->join('kelas', 'wali_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->get();

        return view('admin.rekapdata.rekapdatawalkes', compact('walkes'));
    }
}