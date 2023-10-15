<?php
  
namespace App\Http\Controllers\Guru;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembelajaran;
  
class DashboardguruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        return view('guru.dashboardguru');
    }
}