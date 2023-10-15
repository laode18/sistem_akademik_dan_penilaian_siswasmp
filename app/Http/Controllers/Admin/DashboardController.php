<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
  
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $siswas = DB::table('db_siswa')->get();
        $gurus = DB::table('guru')->get();
        $walkes = DB::table('wali_kelas')->get();
        $ortu = DB::table('orang_tua')->get();

        return view('admin.dashboard', compact('siswas', 'gurus', 'walkes', 'ortu'));
    }
}