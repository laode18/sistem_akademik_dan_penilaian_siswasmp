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
  
class DatanilaiguruController extends Controller
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

        return view('guru.datanilaiguru', compact('absensis'));
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
            ->join('db_siswa', 'kelas.id_kelas', '=', 'db_siswa.id_kelas')
            // ->join('absensi', function ($join) use ($id_bel) {
            //     $join->on('db_siswa.id_siswa', '=', 'absensi.id_siswa')
            //         ->where('absensi.id_bel', $id_bel);
            // })
            ->join('nilai', function ($join) use ($id_bel) {
                $join->on('db_siswa.id_siswa', '=', 'nilai.id_siswa')
                    ->where('nilai.id_bel', $id_bel);
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

        return view('guru.datanilaigurus', compact('absensis', 'filteredAbsensis', 'filteredAbsensiss', 'pem'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'ulangan_harian' => 'required',
            'ulangan_harian1' => 'required',
            'ulangan_harian2' => 'required',
            'ulangan_harian3' => 'required',
            'tugas' => 'required',
            'tugas1' => 'required',
            'nilai_absen' => 'required',
            'uts' => 'required',
            'uas' => 'required',
            'deskripsi' => 'required',
            'id_siswa' => 'required',
            'id_bel' => 'required',
        ]);

        $nilai = Nilai::create([
            'id_nilai' => $request->id_nilai,
            'ulangan_harian' => $request->ulangan_harian,
            'ulangan_harian1' => $request->ulangan_harian1,
            'ulangan_harian2' => $request->ulangan_harian2,
            'ulangan_harian3' => $request->ulangan_harian3,
            'tugas' => $request->tugas,
            'tugas1' => $request->tugas1,
            'nilai_absen' => $request->nilai_absen,
            'uts' => $request->uts,
            'uas' => $request->uas,
            'deskripsi' => $request->deskripsi,
            'id_siswa' => $request->id_siswa,
            'id_bel' => $request->id_bel,
        
        ]);

        if($nilai){
        //redirect dengan pesan sukses
            return back()->with(['success' => 'Data Saved Successfully!']);
        }else{
        //redirect dengan pesan error
            return back()->with(['error' => 'Data Save Failed!']);
        }

    }

    public function update(Request $request)
    {
        DB::table('nilai')->where('id_nilai',$request->id_nilai)->update([
            'ulangan_harian' => $request->ulangan_harian,
            'ulangan_harian1' => $request->ulangan_harian1,
            'ulangan_harian2' => $request->ulangan_harian2,
            'ulangan_harian3' => $request->ulangan_harian3,
            'tugas' => $request->tugas,
            'tugas1' => $request->tugas1,
            'nilai_absen' => $request->nilai_absen,
            'uts' => $request->uts,
            'uas' => $request->uas,
            'deskripsi' => $request->deskripsi,
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