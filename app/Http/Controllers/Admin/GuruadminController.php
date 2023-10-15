<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Guru;
use App\Models\User;
use Hash;
  
class GuruadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $gurus = DB::table('guru')->get();

        $q = DB::table('guru')->select(DB::raw('MAX(RIGHT(id_guru,1)) as kode'));
        $kq="";
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kode)+1;
                $kq = sprintf("%01s",$tmp);
            }
        }
        else {
            $kq = "5";
        }

        return view('admin.guruadmin', compact('gurus', 'kq'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'id_guru' => 'required',
            'nuptk' => 'required',
            'nama_guru' => 'required',
            'jenis_kel' => 'required',
            'foto' => 'required',
            'password' => 'required',
        ]);

        $ambil=$request->file('foto');
        $name=$ambil->getClientOriginalName();
        $namaFileBaru = uniqid();
        $namaFileBaru .= $name;
        $ambil->move(\base_path()."/public/images", $namaFileBaru);

        $guru = Guru::create([
            'id_guru' => $request->id_guru,
            'nuptk' => $request->nuptk,
            'nama_guru' => $request->nama_guru,
            'jenis_kel' => $request->jenis_kel,
            'foto' => $namaFileBaru,
            'password' => $request->password,
        
        ]);

        $user = new User();
        $user->id = $request->id_guru;
        $user->name = $request->post('nama_guru');
        $user->email = $request->post('nuptk');
        $user->password = Hash::make($request->post('password'));
        $user->level = 'guru';
        $user->save();

        if($guru){
        //redirect dengan pesan sukses
            return redirect()->route('dataguruadmin')->with(['success' => 'Data Saved Successfully!']);
        }else{
        //redirect dengan pesan error
            return redirect()->route('dataguruadmin')->with(['error' => 'Data Save Failed!']);
        }

    }

    public function update(Request $request)
    {
        $ambil=$request->file('foto');
        $name=$ambil->getClientOriginalName();
        $namaFileBaru = uniqid();
        $namaFileBaru .= $name;
        $ambil->move(\base_path()."/public/images", $namaFileBaru);

        DB::table('guru')->where('id_guru',$request->id_guru)->update([
            'nuptk' => $request->nuptk,
            'nama_guru' => $request->nama_guru,
            'jenis_kel' => $request->jenis_kel,
            'foto' => $namaFileBaru,
            'password' => $request->password,
        ]);

        DB::table('users')->where('id',$request->id_guru)->update([
            'name' => $request->nama_guru,
            'email' => $request->nuptk,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/dataguruadmin')->with(['success' => 'Data Updated Successfully!']);
    }

    public function destroy($id_guru)
    {
        DB::table('guru')->where('id_guru', $id_guru)->delete();
        DB::table('users')->where('id', $id_guru)->delete();

        return redirect ('/dataguruadmin')->with(['success' => 'Data Deleted Successfully!']);
    }
}