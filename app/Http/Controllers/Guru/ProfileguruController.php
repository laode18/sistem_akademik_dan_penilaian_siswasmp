<?php
  
namespace App\Http\Controllers\Guru;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
  
class ProfileguruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $idGuru = Auth::user()->id;

        $guru = DB::table('guru')
            ->where('guru.id_guru', '=', $idGuru)
            ->get();

        return view('guru.profileguru', compact('guru'));
    }

    public function update(Request $request)
    {
        $ambil=$request->file('foto');
        $name=$ambil->getClientOriginalName();
        $namaFileBaru = uniqid();
        $namaFileBaru .= $name;
        $ambil->move(\base_path()."/public/images", $namaFileBaru);

        DB::table('guru')->where('id_guru',$request->id_guru)->update([
            'foto' => $namaFileBaru,
            'password' => $request->password,
        ]);

        DB::table('users')->where('id',$request->id_guru)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect('/profileguru')->with(['success' => 'Data Updated Successfully!']);
    }
}