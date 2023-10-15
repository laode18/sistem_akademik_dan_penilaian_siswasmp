<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Absen;
use App\Models\Pembelajaran;

class DataabsenguruController extends Controller
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

        return view('guru.dataabsengurus', compact('absensis'));
    }

    public function filter($id_bel)
    {
        $idGuru = Auth::user()->id;

        $filteredAbsensis = Pembelajaran::join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
            ->join('db_siswa as siswa2', 'kelas.id_kelas', '=', 'siswa2.id_kelas')
            ->where('id_bel', $id_bel)
            ->get();

        $pem = DB::table('pembelajaran')->where('id_bel', $id_bel)->get();
        
        $filteredAbsensisss = DB::table('pembelajaran')
            ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
            ->join('db_siswa as siswa2', 'kelas.id_kelas', '=', 'siswa2.id_kelas')
            // ->join('absensi', function ($join) use ($id_bel) {
            //     $join->on('siswa2.id_siswa', '=', 'absensi.id_siswa')
            //         ->where('absensi.id_bel', $id_bel);
            // })
            ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
            ->where('pembelajaran.id_bel', $id_bel)
            ->get();

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
        
        // $absenss = DB::table("db_siswa")
        //     ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
        //     ->

        $absensis = DB::table('pembelajaran')
            ->join('guru', 'pembelajaran.id_guru', '=', 'guru.id_guru')
            ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
            ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
            ->where('guru.id_guru', '=', $idGuru)
            ->get();

        return view('guru.dataabsenguru', compact('absensis', 'filteredAbsensis', 'filteredAbsensiss', 'filteredAbsensisss', 'pem'));
    }

    public function store(Request $request)
    {
        $pertemuan = $request->input('pertemuan');
        $tanggal = $request->input('tanggal');
        $id_bel = $request->input('id_bel');
        $nama_siswa = $request->input('nama_siswa');
        $hadir = $request->input('hadir');
        $sakit = $request->input('sakit');
        $izin = $request->input('izin');
        $alpa = $request->input('alpa');
        $pokok_pembahasan = $request->input('pokok_pembahasan');

        // Loop through the students and save their attendance
        foreach ($nama_siswa as $index => $id_siswa) {
            Absen::create([
                'pertemuan' => $pertemuan,
                'tanggal' => $tanggal,
                'id_bel' => $id_bel,
                'id_siswa' => $id_siswa,
                'hadir' => isset($hadir[$id_siswa]) ? 1 : 0,
                'sakit' => isset($sakit[$id_siswa]) ? 1 : 0,
                'izin' => isset($izin[$id_siswa]) ? 1 : 0,
                'alpa' => isset($alpa[$id_siswa]) ? 1 : 0,
                'pokok_pembahasan' => $pokok_pembahasan,
                // Add other attributes as needed
            ]);
        }

        // Redirect with success message
        return back()->with(['success' => 'Data Saved Successfully!']);
    }


   public function update(Request $request, $pertemuan)
{
    $id_absen = $request->input('id_absen');
    $tanggal = $request->input('tanggal');
    $pokok_pembahasan = $request->input('pokok_pembahasan');
    $nama_siswa = $request->input('nama_siswa');
    $hadir = $request->input('hadir');
    $sakit = $request->input('sakit');
    $izin = $request->input('izin');
    $alpa = $request->input('alpa');

    // Loop through the students and update their attendance
    foreach ($id_absen as $index => $id_absensi) {
        Absen::where([
            'pertemuan' => $pertemuan,
            'id_absensi' => $id_absensi,
        ])->update([
            'tanggal' => $tanggal,
            'pokok_pembahasan' => $pokok_pembahasan,
            'hadir' => isset($hadir[$id_absensi]) ? 1 : 0,
            'sakit' => isset($sakit[$id_absensi]) ? 1 : 0,
            'izin' => isset($izin[$id_absensi]) ? 1 : 0,
            'alpa' => isset($alpa[$id_absensi]) ? 1 : 0,
            // Add other attributes as needed
        ]);
    }

    // Redirect with success message
    return back()->with(['success' => 'Data Updated Successfully!']);
}

    public function destroy($id_absensi)
    {
        DB::table('absensi')->where('id_absensi', $id_absensi)->delete();

        return back()->with(['success' => 'Data Deleted Successfully!']);
    }
    
}
