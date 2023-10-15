<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
  
class LaporanguruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        $gurus = DB::table('guru')
            ->get();
        
        foreach ($gurus as $guru) {

            }
        
        return view('admin.rekapdata.rekapdataguru', compact('gurus'));
    }
}