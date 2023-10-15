<?php
  
namespace App\Http\Controllers\Siswa;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembelajaran;
  
class HomesiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('siswa.homesiswa');
    }

    public function filter($id_siswa)
    {
        $id_siswa = Auth::user()->id;

        $filteredAbsensiss = DB::table('db_siswa')
    ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
    ->join('absensi', function ($join) use ($id_siswa) {
        $join->on('db_siswa.id_siswa', '=', 'absensi.id_siswa')
            ->where('absensi.id_siswa', '=', $id_siswa);
    })
    ->join('nilai', 'db_siswa.id_siswa', '=', 'nilai.id_siswa')
    ->join('pembelajaran', function ($join) use ($id_siswa) {
        $join->on('nilai.id_bel', '=', 'pembelajaran.id_bel')
            ->on('absensi.id_bel', '=', 'pembelajaran.id_bel')
            ->where('nilai.id_siswa', '=', $id_siswa);
    })
    ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
    ->where('db_siswa.id_siswa', $id_siswa)
    ->select('mata_pelajaran.id_matpel', 'mata_pelajaran.nama_matpel', 'nilai.deskripsi', DB::raw('((MAX(nilai.nilai_absen) + (MAX(nilai.ulangan_harian) + MAX(nilai.ulangan_harian1) + MAX(nilai.ulangan_harian2) + MAX(nilai.ulangan_harian3))/4) + ((MAX(nilai.tugas) + MAX(nilai.tugas1))/2) + MAX(nilai.uts) + MAX(nilai.uas)) / 5 as rata_nilai'))
    ->groupBy('mata_pelajaran.id_matpel', 'mata_pelajaran.nama_matpel', 'nilai.deskripsi')
    ->get();

    

        return view('siswa.transkripnilaisiswa', compact('filteredAbsensiss'));
    }

    public function absen($id_bel)
    {
        $id_siswa = Auth::user()->id;

        $filteredAbsensiss = DB::table('db_siswa')
        ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
        ->join('absensi', function ($join) use ($id_siswa) {
            $join->on('db_siswa.id_siswa', '=', 'absensi.id_siswa')
                ->where('absensi.id_siswa', '=', $id_siswa);
        })
        ->join('nilai', 'db_siswa.id_siswa', '=', 'nilai.id_siswa')
        ->join('pembelajaran', function ($join) use ($id_siswa) {
            $join->on('nilai.id_bel', '=', 'pembelajaran.id_bel')
                ->on('absensi.id_bel', '=', 'pembelajaran.id_bel')
                ->where('nilai.id_siswa', '=', $id_siswa);
        })
        ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
        ->where('pembelajaran.id_bel', $id_bel)
        ->select('mata_pelajaran.id_matpel', 'mata_pelajaran.nama_matpel', 'kelas.nama_kelas', 'db_siswa.nama_siswa', 'absensi.tanggal', 'absensi.pertemuan', 'absensi.hadir', 'absensi.sakit', 'absensi.izin', 'absensi.alpa', 'absensi.pokok_pembahasan', DB::raw('((MAX(nilai.nilai_absen) + (MAX(nilai.ulangan_harian) + MAX(nilai.ulangan_harian1) + MAX(nilai.ulangan_harian2) + MAX(nilai.ulangan_harian3))/4) + ((MAX(nilai.tugas) + MAX(nilai.tugas1))/2) + MAX(nilai.uts) + MAX(nilai.uas)) / 5 as rata_nilai'))
        ->groupBy('mata_pelajaran.id_matpel', 'mata_pelajaran.nama_matpel', 'kelas.nama_kelas', 'db_siswa.nama_siswa', 'absensi.tanggal', 'absensi.pertemuan', 'absensi.hadir', 'absensi.sakit', 'absensi.izin', 'absensi.alpa', 'absensi.pokok_pembahasan')
        ->get();

        return view('siswa.absensiswa', compact('filteredAbsensiss'));
    }

    public function absensi()
    {
        $idSiswa = Auth::user()->id;

        $absensis = DB::table('pembelajaran')
            ->join('guru', 'pembelajaran.id_guru', '=', 'guru.id_guru')
            ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
            ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
            ->join('db_siswa', 'kelas.id_kelas', '=', 'db_siswa.id_kelas')
            ->where('db_siswa.id_siswa', '=', $idSiswa)
            ->get();

        return view('siswa.daftarabsen', compact('absensis'));
    }
}