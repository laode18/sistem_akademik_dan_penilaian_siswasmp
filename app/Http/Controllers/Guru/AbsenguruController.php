<?php
  
namespace App\Http\Controllers\Guru;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Pembelajaran;
  
class AbsenguruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $idGuru = Auth::user()->id;

        $absensis = DB::table('pembelajaran')
            ->join('guru', 'pembelajaran.id_guru', '=', 'guru.id_guru')
            ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
            ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
            ->where('guru.id_guru', '=', $idGuru)
            ->get();

        return view('guru.absengurus', compact('absensis'));
    }

    public function filter($id_bel)
    {
        $idGuru = Auth::user()->id;

        $filteredAbsensis = Pembelajaran::join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
            ->join('db_siswa as siswa2', 'kelas.id_kelas', '=', 'siswa2.id_kelas')
            ->where('id_bel', $id_bel)
            ->get();

        $pem = DB::table('pembelajaran')->where('id_bel', $id_bel)->get();
        
        $filteredAbsensiss = DB::table('pembelajaran')
            ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
            ->join('db_siswa as siswa2', 'kelas.id_kelas', '=', 'siswa2.id_kelas')
            ->join('absensi', function ($join) use ($id_bel) {
                $join->on('siswa2.id_siswa', '=', 'absensi.id_siswa')
                    ->where('absensi.id_bel', $id_bel);
            })
            ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
            ->where('pembelajaran.id_bel', $id_bel)
            ->get();

        $absensis = DB::table('pembelajaran')
            ->join('guru', 'pembelajaran.id_guru', '=', 'guru.id_guru')
            ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
            ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
            ->where('guru.id_guru', '=', $idGuru)
            ->get();

        return view('guru.absenguru', compact('absensis', 'filteredAbsensis', 'filteredAbsensiss', 'pem'));
    }

    public function update(Request $request)
    {
        DB::table('nilai')->where('id_nilai',$request->id_nilai)->update([
            'ulangan_harian' => $request->ulangan_harian,
            'tugas' => $request->tugas,
            'uts' => $request->uts,
            'uas' => $request->uas,
            'id_siswa' => $request->id_siswa,
            'id_bel' => $request->id_bel,
        ]);

        return back()->with(['success' => 'Data Updated Successfully!']);
    }

    public function destroy($id_nilai)
    {
        DB::table('nilai')->where('id_nilai', $id_nilai)->delete();

        return back()->with(['success' => 'Data Deleted Successfully!']);
    }
}