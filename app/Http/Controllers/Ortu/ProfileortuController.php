<?php
  
namespace App\Http\Controllers\Ortu;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
  
class ProfileortuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $idOrtu = Auth::user()->id;

        $ortu = DB::table('orang_tua')
            ->where('orang_tua.id_ortu', '=', $idOrtu)
            ->get();

        return view('ortu.profileortu', compact('ortu'));
    }

    public function update(Request $request)
    {

        DB::table('orang_tua')->where('id_ortu',$request->id_ortu)->update([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        DB::table('users')->where('id',$request->id_ortu)->update([
            'email' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/profileortu')->with(['success' => 'Data Updated Successfully!']);
    }
}