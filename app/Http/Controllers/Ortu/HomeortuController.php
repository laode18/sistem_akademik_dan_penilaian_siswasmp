<?php
  
namespace App\Http\Controllers\Ortu;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembelajaran;
  
class HomeortuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('ortu.homeortu');
    }

    public function filter($id_ortu)
    {
        $id_ortu = Auth::user()->id;

        $id_siswas = DB::table('db_siswa')->pluck('id_siswa');

$filteredAbsensiss = DB::table('orang_tua')
    ->join('db_siswa', 'orang_tua.id_siswa', '=', 'db_siswa.id_siswa')
    ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
    ->leftJoin('absensi', function ($join) use ($id_siswas) {
        $join->on('db_siswa.id_siswa', '=', 'absensi.id_siswa')
            ->whereIn('absensi.id_siswa', $id_siswas);
    })
    ->join('nilai', 'db_siswa.id_siswa', '=', 'nilai.id_siswa')
    ->leftJoin('pembelajaran', function ($join) use ($id_siswas) {
        $join->on('nilai.id_bel', '=', 'pembelajaran.id_bel')
            ->on('absensi.id_bel', '=', 'pembelajaran.id_bel')
            ->whereIn('nilai.id_siswa', $id_siswas);
    })
    ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
    ->where('orang_tua.id_ortu', $id_ortu)
    ->whereIn('db_siswa.id_siswa', $id_siswas)
    ->select('mata_pelajaran.id_matpel', 'mata_pelajaran.nama_matpel', 'nilai.deskripsi', DB::raw('((MAX(nilai.nilai_absen) + (MAX(nilai.ulangan_harian) + MAX(nilai.ulangan_harian1) + MAX(nilai.ulangan_harian2) + MAX(nilai.ulangan_harian3))/4) + ((MAX(nilai.tugas) + MAX(nilai.tugas1))/2) + MAX(nilai.uts) + MAX(nilai.uas)) / 5 as rata_nilai'))
    ->groupBy('mata_pelajaran.id_matpel', 'mata_pelajaran.nama_matpel', 'nilai.deskripsi')
    ->get();



        $filteredAbsensistr = DB::table('orang_tua')
            ->join('db_siswa', 'orang_tua.id_siswa', '=', 'db_siswa.id_siswa')
            ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('orang_tua.id_ortu', $id_ortu)
            ->get();

        return view('ortu.nilaianak', compact('filteredAbsensiss', 'filteredAbsensistr'));
    }

    public function absen($id_bel)
    {
        $id_ortu = Auth::user()->id;

        $id_siswas = DB::table('db_siswa')->pluck('id_siswa');

        $filteredAbsensiss = DB::table('orang_tua')
            ->join('db_siswa', 'orang_tua.id_siswa', '=', 'db_siswa.id_siswa')
            ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->leftJoin('absensi', function ($join) use ($id_siswas) {
                $join->on('db_siswa.id_siswa', '=', 'absensi.id_siswa')
                    ->whereIn('absensi.id_siswa', $id_siswas);
            })
            ->join('nilai', 'db_siswa.id_siswa', '=', 'nilai.id_siswa')
            ->leftJoin('pembelajaran', function ($join) use ($id_siswas) {
                $join->on('nilai.id_bel', '=', 'pembelajaran.id_bel')
                    ->on('absensi.id_bel', '=', 'pembelajaran.id_bel')
                    ->whereIn('nilai.id_siswa', $id_siswas);
            })
            ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
            ->where('pembelajaran.id_bel', $id_bel)
            ->whereIn('db_siswa.id_siswa', $id_siswas)
            ->select('mata_pelajaran.id_matpel', 'mata_pelajaran.nama_matpel', 'kelas.nama_kelas', 'db_siswa.nama_siswa', 'absensi.tanggal', 'absensi.pertemuan', 'absensi.hadir', 'absensi.sakit', 'absensi.izin', 'absensi.alpa', 'absensi.pokok_pembahasan', DB::raw('((MAX(nilai.nilai_absen) + (MAX(nilai.ulangan_harian) + MAX(nilai.ulangan_harian1) + MAX(nilai.ulangan_harian2) + MAX(nilai.ulangan_harian3))/4) + ((MAX(nilai.tugas) + MAX(nilai.tugas1))/2) + MAX(nilai.uts) + MAX(nilai.uas)) / 5 as rata_nilai'))
        ->groupBy('mata_pelajaran.id_matpel', 'mata_pelajaran.nama_matpel', 'kelas.nama_kelas', 'db_siswa.nama_siswa', 'absensi.tanggal', 'absensi.pertemuan', 'absensi.hadir', 'absensi.sakit', 'absensi.izin', 'absensi.alpa', 'absensi.pokok_pembahasan')
            ->get();



        $filteredAbsensistr = DB::table('orang_tua')
            ->join('db_siswa', 'orang_tua.id_siswa', '=', 'db_siswa.id_siswa')
            ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('orang_tua.id_ortu', $id_ortu)
            ->get();

        return view('ortu.absenortu', compact('filteredAbsensiss', 'filteredAbsensistr'));
    }

    public function absensi()
    {
        $idSiswa = Auth::user()->id;

        $absensis = DB::table('pembelajaran')
            ->join('guru', 'pembelajaran.id_guru', '=', 'guru.id_guru')
            ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
            ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
            ->join('db_siswa', 'kelas.id_kelas', '=', 'db_siswa.id_kelas')
            ->join('orang_tua', 'db_siswa.id_siswa', '=', 'orang_tua.id_siswa')
            ->where('orang_tua.id_ortu', '=', $idSiswa)
            ->get();

        $filteredAbsensistr = DB::table('orang_tua')
            ->join('db_siswa', 'orang_tua.id_siswa', '=', 'db_siswa.id_siswa')
            ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('orang_tua.id_ortu', $idSiswa)
            ->get();


        return view('ortu.daftarabsenortu', compact('absensis', 'filteredAbsensistr'));
    }
}