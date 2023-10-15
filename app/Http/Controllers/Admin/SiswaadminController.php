<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Hash;
  
class SiswaadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $siswas = DB::table('db_siswa')
                    ->join('kelas', 'kelas.id_kelas', '=', 'db_siswa.id_kelas')
                    ->where('nama_kelas', 'LIKE', '7%')
                    ->get();

        $data = DB::table('db_siswa')
                    ->join('kelas', 'kelas.id_kelas', '=', 'db_siswa.id_kelas')
                    ->join('pembelajaran', 'kelas.id_kelas', '=', 'pembelajaran.id_kelas')
                    ->where('nama_kelas', 'LIKE', '7%')
                    ->get();
                    
        $kelas = DB::table('kelas')
            ->where('nama_kelas', 'LIKE', '7%')
            ->get();

        $q = DB::table('db_siswa')->select(DB::raw('MAX(RIGHT(id_siswa,1)) as kode'))
            ->where('id_siswa', 'LIKE', 'SW7-%')
            ->first();
        $kd = "";
        if ($q) {
            $tmp = ((int)$q->kode) + 1;
            $kd = sprintf("%01s", $tmp);
        } else {
            $kd = "5";
        }

        return view('admin.siswaadmin', compact('siswas', 'kelas', 'kd', 'data'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'id_siswa' => 'required',
            'nisn' => 'required',
            'nama_siswa' => 'required',
            'jenis_kel' => 'required',
            'id_kelas' => 'required',
            'tanggal_lahir' => 'required',
            'foto' => 'required',
        ]);

        $ambil=$request->file('foto');
        $name=$ambil->getClientOriginalName();
        $namaFileBaru = uniqid();
        $namaFileBaru .= $name;
        $ambil->move(\base_path()."/public/images", $namaFileBaru);

        $siswa = Siswa::create([
            'id_siswa' => $request->id_siswa,
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kel' => $request->jenis_kel,
            'id_kelas' => $request->id_kelas,
            'tanggal_lahir' => $request->tanggal_lahir,
            'foto' => $namaFileBaru,
            'password' => $request->password,
        
        ]);

        $user = new User();
        $user->id = $request->id_siswa;
        $user->name = $request->post('nama_siswa');
        $user->email = $request->post('nisn');
        $user->password = Hash::make($request->post('password'));
        $user->level = 'siswa';
        $user->save();

        if($siswa){
        //redirect dengan pesan sukses
            return redirect()->route('datasiswaadmin')->with(['success' => 'Data Saved Successfully!']);
        }else{
        //redirect dengan pesan error
            return redirect()->route('datasiswaadmin')->with(['error' => 'Data Save Failed!']);
        }

    }

    public function update(Request $request)
    {
        $ambil=$request->file('foto');
        $name=$ambil->getClientOriginalName();
        $namaFileBaru = uniqid();
        $namaFileBaru .= $name;
        $ambil->move(\base_path()."/public/images", $namaFileBaru);

        DB::table('db_siswa')->where('id_siswa',$request->id_siswa)->update([
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kel' => $request->jenis_kel,
            'id_kelas' => $request->id_kelas,
            'tanggal_lahir' => $request->tanggal_lahir,
            'foto' => $namaFileBaru,
            'password' => $request->password,
        ]);

        DB::table('users')->where('id',$request->id_siswa)->update([
            'name' => $request->nama_siswa,
            'email' => $request->nisn,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/datasiswaadminkelas7')->with(['success' => 'Data Updated Successfully!']);
    }

    public function destroy($id_siswa)
    {
        DB::table('db_siswa')->where('id_siswa', $id_siswa)->delete();
        DB::table('users')->where('id', $id_siswa)->delete();

        return redirect ('/datasiswaadminkelas7')->with(['success' => 'Data Deleted Successfully!']);
    }
}