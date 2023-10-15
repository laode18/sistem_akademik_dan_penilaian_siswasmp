<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Matpel;
  
class MatpeladminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $matpels = DB::table('mata_pelajaran')->get();

        return view('admin.matpeladmin', compact('matpels'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'nama_matpel' => 'required',
        ]);

        $matpel = Matpel::create([
            'id_matpel' => $request->id_matpel,
            'nama_matpel' => $request->nama_matpel,
        
        ]);

        if($matpel){
        //redirect dengan pesan sukses
            return redirect()->route('matpeladmin')->with(['success' => 'Data Saved Successfully!']);
        }else{
        //redirect dengan pesan error
            return redirect()->route('matpeladmin')->with(['error' => 'Data Save Failed!']);
        }

    }

    public function update(Request $request)
    {
        DB::table('mata_pelajaran')->where('id_matpel',$request->id_matpel)->update([
            'nama_matpel' => $request->nama_matpel,
        ]);

        return redirect('/matpeladmin')->with(['success' => 'Data Updated Successfully!']);
    }

    public function destroy($id_matpel)
    {
        DB::table('mata_pelajaran')->where('id_matpel', $id_matpel)->delete();

        return redirect ('/matpeladmin')->with(['success' => 'Data Deleted Successfully!']);
    }
}