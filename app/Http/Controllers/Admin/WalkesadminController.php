<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Walkes;
use App\Models\Tingkel;
use App\Models\Kelas;
use App\Models\User;
use Hash;
  
class WalkesadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $walkes = DB::table('wali_kelas')
                    ->join('kelas', 'kelas.id_kelas', '=', 'wali_kelas.id_kelas')
                    ->get();

        $tingkels = DB::table('tingkatan_kelas')->get();
                    
        $kelas = DB::table('kelas')->get();

        $q = DB::table('wali_kelas')->select(DB::raw('MAX(RIGHT(id_walkes,1)) as kode'));
        $kw="";
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kode)+1;
                $kw = sprintf("%01s",$tmp);
            }
        }
        else {
            $kw = "5";
        }

        return view('admin.walkesadmin', compact('walkes', 'tingkels', 'kelas', 'kw'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'id_walkes' => 'required',
            'nuptk' => 'required',
            'nama_walkes' => 'required',
            'jenis_kel' => 'required',
            'id_kelas' => 'required',
            'foto' => 'required',
            'password' => 'required',
        ]);

        $ambil=$request->file('foto');
        $name=$ambil->getClientOriginalName();
        $namaFileBaru = uniqid();
        $namaFileBaru .= $name;
        $ambil->move(\base_path()."/public/images", $namaFileBaru);

        $walkes = Walkes::create([
            'id_walkes' => $request->id_walkes,
            'nuptk' => $request->nuptk,
            'nama_walkes' => $request->nama_walkes,
            'jenis_kel' => $request->jenis_kel,
            'id_kelas' => $request->id_kelas,
            'foto' => $namaFileBaru,
            'password' => $request->password,
        
        ]);

        $user = new User();
        $user->id = $request->id_walkes;
        $user->name = $request->post('nama_walkes');
        $user->email = $request->post('nuptk');
        $user->password = Hash::make($request->post('password'));
        $user->level = 'walkes';
        $user->save();

        if($walkes){
        //redirect dengan pesan sukses
            return redirect()->route('datawalkesadmin')->with(['success' => 'Data Saved Successfully!']);
        }else{
        //redirect dengan pesan error
            return redirect()->route('datawalkesadmin')->with(['error' => 'Data Save Failed!']);
        }

    }

    public function update(Request $request)
    {
        $ambil=$request->file('foto');
        $name=$ambil->getClientOriginalName();
        $namaFileBaru = uniqid();
        $namaFileBaru .= $name;
        $ambil->move(\base_path()."/public/images", $namaFileBaru);

        DB::table('wali_kelas')->where('id_walkes',$request->id_walkes)->update([
            'nuptk' => $request->nuptk,
            'nama_walkes' => $request->nama_walkes,
            'jenis_kel' => $request->jenis_kel,
            'id_kelas' => $request->id_kelas,
            'foto' => $namaFileBaru,
            'password' => $request->password,
        ]);

        DB::table('users')->where('id',$request->id_walkes)->update([
            'name' => $request->nama_walkes,
            'email' => $request->nuptk,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/datawalkesadmin')->with(['success' => 'Data Updated Successfully!']);
    }

    public function destroy($id_walkes)
    {
        DB::table('wali_kelas')->where('id_walkes', $id_walkes)->delete();
        DB::table('users')->where('id', $id_walkes)->delete();

        return redirect ('/datawalkesadmin')->with(['success' => 'Data Deleted Successfully!']);
    }
}