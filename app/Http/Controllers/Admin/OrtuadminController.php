<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ortu;
use App\Models\Siswa;
use App\Models\User;
use Hash;
  
class OrtuadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $ortus = DB::table('orang_tua')
                    ->join('db_siswa', 'db_siswa.id_siswa', '=', 'orang_tua.id_siswa')
                    ->get();
                    
        $siswas = DB::table('db_siswa')->get();

        $q = DB::table('orang_tua')->select(DB::raw('MAX(RIGHT(id_ortu,1)) as kode'));
        $or="";
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kode)+1;
                $or = sprintf("%01s",$tmp);
            }
        }
        else {
            $or = "5";
        }

        return view('admin.ortuadmin', compact('ortus', 'siswas', 'or'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'id_ortu' => 'required',
            'id_siswa' => 'required',
            'nama_ortu' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $ortus = Ortu::create([
            'id_ortu' => $request->id_ortu,
            'id_siswa' => $request->id_siswa,
            'nama_ortu' => $request->nama_ortu,
            'alamat' => $request->alamat,
            'username' => $request->username,
            'password' => $request->password,
        
        ]);

        $user = new User();
        $user->id = $request->id_ortu;
        $user->name = $request->post('nama_ortu');
        $user->email = $request->post('username');
        $user->password = Hash::make($request->post('password'));
        $user->level = 'ortu';
        $user->save();

        if($ortus){
        //redirect dengan pesan sukses
            return redirect()->route('dataortuadmin')->with(['success' => 'Data Saved Successfully!']);
        }else{
        //redirect dengan pesan error
            return redirect()->route('dataortuadmin')->with(['error' => 'Data Save Failed!']);
        }

    }

    public function update(Request $request)
    {

        DB::table('orang_tua')->where('id_ortu',$request->id_ortu)->update([
            'id_siswa' => $request->id_siswa,
            'nama_ortu' => $request->nama_ortu,
            'alamat' => $request->alamat,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        DB::table('users')->where('id',$request->id_ortu)->update([
            'name' => $request->nama_ortu,
            'email' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/dataortuadmin')->with(['success' => 'Data Updated Successfully!']);
    }

    public function destroy($id_ortu)
    {
        DB::table('orang_tua')->where('id_ortu', $id_ortu)->delete();
        DB::table('users')->where('id', $id_ortu)->delete();

        return redirect ('/dataortuadmin')->with(['success' => 'Data Deleted Successfully!']);
    }
}