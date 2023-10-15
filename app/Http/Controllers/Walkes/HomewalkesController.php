<?php

namespace App\Http\Controllers\Walkes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembelajaran;

class HomewalkesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('walkes.homewalkes');
    }

    public function filter()
    {
        $id_walkes = Auth::user()->id;

        $id_siswas = DB::table('nilai')->pluck('id_siswa');

        $filteredAbsensiss = DB::table('wali_kelas')
            ->join('kelas', 'wali_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->join('db_siswa', 'kelas.id_kelas', '=', 'db_siswa.id_kelas')
            ->where('wali_kelas.id_walkes', $id_walkes)
            ->get();

        $filteredAbsensisd = DB::table('wali_kelas')
            ->join('kelas', 'wali_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->join('db_siswa', 'kelas.id_kelas', '=', 'db_siswa.id_kelas')
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
            ->where('wali_kelas.id_walkes', $id_walkes)
            ->whereIn('db_siswa.id_siswa', $id_siswas)
            ->select('mata_pelajaran.id_matpel', 'mata_pelajaran.*', 'nilai.*', 'db_siswa.*', 'kelas.*')
            ->selectRaw('MAX((nilai.nilai_absen + ((nilai.ulangan_harian + nilai.ulangan_harian1 + nilai.ulangan_harian2 + nilai.ulangan_harian3)/4) + ((nilai.tugas + nilai.tugas1)/2) + nilai.uts + nilai.uas) / 5) as rata_nilai')
            ->groupBy('mata_pelajaran.id_matpel', 'kelas.id_kelas', 'kelas.nama_kelas', 'mata_pelajaran.nama_matpel', 'mata_pelajaran.id_matpel', 'nilai.id_nilai', 'nilai.ulangan_harian', 'nilai.ulangan_harian1', 'nilai.ulangan_harian2', 'nilai.ulangan_harian3', 'nilai.tugas', 'db_siswa.nama_siswa', 'nilai.tugas1', 'nilai.uas', 'nilai.nilai_absen', 'nilai.uts', 'nilai.deskripsi', 'nilai.id_bel', 'db_siswa.id_siswa', 'db_siswa.nisn', 'db_siswa.jenis_kel', 'db_siswa.id_kelas', 'db_siswa.tanggal_lahir', 'db_siswa.foto', 'db_siswa.password' ,'nilai.id_siswa')
            ->get();

        
        $filteredAbsensist = DB::table('nilai')
            ->join('db_siswa', 'nilai.id_siswa', '=', 'db_siswa.id_siswa')
            ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('pembelajaran', function ($join) use ($id_walkes) {
                $join->on('nilai.id_bel', '=', 'pembelajaran.id_bel')
                    ->whereColumn('pembelajaran.id_kelas', '=', 'kelas.id_kelas');
            })
            ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
            ->whereIn('nilai.id_siswa', $id_siswas)
            ->whereNotNull('nilai.uas')
            ->select('mata_pelajaran.id_matpel', 'mata_pelajaran.nama_matpel', 'nilai.*')
            ->distinct()
            ->get();

        return view('walkes.nilaisiswawalkes', compact('filteredAbsensisd', 'filteredAbsensiss', 'filteredAbsensist'));
    }

    public function absen($id_bel)
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

        return view('walkes.absensiswawalkes', compact('absensis', 'filteredAbsensis', 'filteredAbsensiss', 'pem'));
    }
}
