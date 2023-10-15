<?php
  
namespace App\Http\Controllers\Siswa;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
  
class ProfilesiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $idSiswa = Auth::user()->id;

        $siswa = DB::table('db_siswa')
            ->where('db_siswa.id_siswa', '=', $idSiswa)
            ->get();

        return view('siswa.profilesiswa', compact('siswa'));
    }

    public function update(Request $request)
    {
        $ambil=$request->file('foto');
        $name=$ambil->getClientOriginalName();
        $namaFileBaru = uniqid();
        $namaFileBaru .= $name;
        $ambil->move(\base_path()."/public/images", $namaFileBaru);

        DB::table('db_siswa')->where('id_siswa',$request->id_siswa)->update([
            'foto' => $namaFileBaru,
            'password' => $request->password,
        ]);

        DB::table('users')->where('id',$request->id_siswa)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect('/profilesiswa')->with(['success' => 'Data Updated Successfully!']);
    }
}