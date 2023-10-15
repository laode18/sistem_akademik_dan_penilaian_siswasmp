<?php
  
namespace App\Http\Controllers\Walkes;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
  
class ProfilewalkesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $idWalkes = Auth::user()->id;

        $walkes = DB::table('wali_kelas')
            ->where('wali_kelas.id_walkes', '=', $idWalkes)
            ->get();

        return view('walkes.profilewalkes', compact('walkes'));
    }

    public function update(Request $request)
    {
        $ambil=$request->file('foto');
        $name=$ambil->getClientOriginalName();
        $namaFileBaru = uniqid();
        $namaFileBaru .= $name;
        $ambil->move(\base_path()."/public/images", $namaFileBaru);

        DB::table('wali_kelas')->where('id_walkes',$request->id_walkes)->update([
            'foto' => $namaFileBaru,
            'password' => $request->password,
        ]);

        DB::table('users')->where('id',$request->id_walkes)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect('/profilewalkes')->with(['success' => 'Data Updated Successfully!']);
    }
}