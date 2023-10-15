<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tingkel;
  
class TingkeladminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $tingkels = DB::table('tingkatan_kelas')->get();

        return view('admin.tingkeladmin', compact('tingkels'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'nama_tingkel' => 'required',
        ]);

        $tingkel = Tingkel::create([
            'id_tingkel' => $request->id_tingkel,
            'nama_tingkel' => $request->nama_tingkel,
        
        ]);

        if($tingkel){
        //redirect dengan pesan sukses
            return redirect()->route('tingkeladmin')->with(['success' => 'Data Saved Successfully!']);
        }else{
        //redirect dengan pesan error
            return redirect()->route('tingkeladmin')->with(['error' => 'Data Save Failed!']);
        }

    }

    public function update(Request $request)
    {
        DB::table('tingkatan_kelas')->where('id_tingkel',$request->id_tingkel)->update([
            'nama_tingkel' => $request->nama_tingkel,
        ]);

        return redirect('/tingkeladmin')->with(['success' => 'Data Updated Successfully!']);
    }

    public function destroy($id_tingkel)
    {
        DB::table('tingkatan_kelas')->where('id_tingkel', $id_tingkel)->delete();

        return redirect ('/tingkeladmin')->with(['success' => 'Data Deleted Successfully!']);
    }
}