<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
  
class KelasadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $kelas = DB::table('kelas')->get();

        return view('admin.kelasadmin', compact('kelas'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'nama_kelas' => 'required',
        ]);

        $kelas = Kelas::create([
            'id_kelas' => $request->id_kelas,
            'nama_kelas' => $request->nama_kelas,
        
        ]);

        if($kelas){
        //redirect dengan pesan sukses
            return redirect()->route('kelasadmin')->with(['success' => 'Data Saved Successfully!']);
        }else{
        //redirect dengan pesan error
            return redirect()->route('kelasadmin')->with(['error' => 'Data Save Failed!']);
        }

    }

    public function update(Request $request)
    {
        DB::table('kelas')->where('id_kelas',$request->id_kelas)->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect('/kelasadmin')->with(['success' => 'Data Updated Successfully!']);
    }

    public function destroy($id_kelas)
    {
        DB::table('kelas')->where('id_kelas', $id_kelas)->delete();

        return redirect ('/kelasadmin')->with(['success' => 'Data Deleted Successfully!']);
    }
}