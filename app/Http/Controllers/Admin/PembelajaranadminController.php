<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pembelajaran;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Matpel;
  
class PembelajaranadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $pembelajarans = DB::table('pembelajaran')
                    ->join('kelas', 'kelas.id_kelas', '=', 'pembelajaran.id_kelas')
                    ->join('mata_pelajaran', 'mata_pelajaran.id_matpel', '=', 'pembelajaran.id_matpel')
                    ->join('guru', 'guru.id_guru', '=', 'pembelajaran.id_guru')
                    ->get();

        $matpels = DB::table('mata_pelajaran')->get();
        $gurus = DB::table('guru')->get();
        $kelas = DB::table('kelas')->get();

        $q = DB::table('pembelajaran')->select(DB::raw('MAX(RIGHT(id_bel,1)) as kode'));
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

        return view('admin.pembelajaranadmin', compact('pembelajarans', 'gurus', 'matpels', 'kelas', 'kq'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'id_bel' => 'required',
            'id_guru' => 'required',
            'id_matpel' => 'required',
            'id_kelas' => 'required',
        ]);

        $pembelajarans = Pembelajaran::create([
            'id_bel' => $request->id_bel,
            'id_guru' => $request->id_guru,
            'id_matpel' => $request->id_matpel,
            'id_kelas' => $request->id_kelas,
        
        ]);

        if($pembelajarans){
        //redirect dengan pesan sukses
            return redirect()->route('pembelajaranadmin')->with(['success' => 'Data Saved Successfully!']);
        }else{
        //redirect dengan pesan error
            return redirect()->route('pembelajaranadmin')->with(['error' => 'Data Save Failed!']);
        }

    }

    public function update(Request $request)
    {

        DB::table('pembelajaran')->where('id_bel',$request->id_bel)->update([
            'id_guru' => $request->id_guru,
            'id_matpel' => $request->id_matpel,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect('/pembelajaranadmin')->with(['success' => 'Data Updated Successfully!']);
    }

    public function destroy($id_bel)
    {
        DB::table('pembelajaran')->where('id_bel', $id_bel)->delete();

        return redirect ('/pembelajaranadmin')->with(['success' => 'Data Deleted Successfully!']);
    }
}