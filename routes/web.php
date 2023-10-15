<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
//Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaadminController;
use App\Http\Controllers\Admin\SiswaadminsController;
use App\Http\Controllers\Admin\SiswaadminssController;
use App\Http\Controllers\Admin\GuruadminController;
use App\Http\Controllers\Admin\MatpeladminController;
use App\Http\Controllers\Admin\TingkeladminController;
use App\Http\Controllers\Admin\KelasadminController;
use App\Http\Controllers\Admin\WalkesadminController;
use App\Http\Controllers\Admin\OrtuadminController;
use App\Http\Controllers\Admin\PembelajaranadminController;
use App\Http\Controllers\Admin\LaporansiswaController;
use App\Http\Controllers\Admin\LaporanguruController;
use App\Http\Controllers\Admin\LaporanwalkesController;
use App\Http\Controllers\Admin\LaporanortuController;

//Guru
use App\Http\Controllers\Guru\DashboardguruController;
use App\Http\Controllers\Guru\DataabsenguruController;
use App\Http\Controllers\Guru\DataabsennilaiController;

//Siswa
use App\Http\Controllers\Siswa\HomesiswaController;
use App\Http\Controllers\Siswa\TranskripnilaisiswaController;
use App\Http\Controllers\Siswa\ProfilesiswaController;

//Walkes
use App\Http\Controllers\Walkes\HomewalkesController;
use App\Http\Controllers\Walkes\ProfilewalkesController;

//Walkes
use App\Http\Controllers\Ortu\HomeortuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Login & Logout
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

//Admin
Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

//Data Siswa Admin
Route::get('datasiswaadminkelas7', [App\Http\Controllers\Admin\SiswaadminController::class, 'index'])->name('datasiswaadmin')->middleware('auth');
Route::get('datasiswaadminkelas8', [App\Http\Controllers\Admin\SiswaadminsController::class, 'index'])->name('datasiswaadmins')->middleware('auth');
Route::get('datasiswaadminkelas9', [App\Http\Controllers\Admin\SiswaadminssController::class, 'index'])->name('datasiswaadminss')->middleware('auth');

//Kelas 7
Route::post('/datasiswaadminstore', [App\Http\Controllers\Admin\SiswaadminController::class, 'store'])->name('datasiswaadminstore');
Route::post('/datasiswaadminupdate/{id_siswa}', [App\Http\Controllers\Admin\SiswaadminController::class, 'update'])->name('datasiswaadminupdate');
Route::get('/datasiswaadmindelete/{id_siswa}', [App\Http\Controllers\Admin\SiswaadminController::class, 'destroy'])->name('datasiswaadmindestroy');

//Kelas 8
Route::post('/datasiswaadminsstore', [App\Http\Controllers\Admin\SiswaadminsController::class, 'store'])->name('datasiswaadminsstore');
Route::post('/datasiswaadminsupdate/{id_siswa}', [App\Http\Controllers\Admin\SiswaadminsController::class, 'update'])->name('datasiswaadminsupdate');
Route::get('/datasiswaadminsdelete/{id_siswa}', [App\Http\Controllers\Admin\SiswaadminsController::class, 'destroy'])->name('datasiswaadminsdestroy');

//Kelas 9
Route::post('/datasiswaadminssstore', [App\Http\Controllers\Admin\SiswaadminssController::class, 'store'])->name('datasiswaadminssstore');
Route::post('/datasiswaadminssupdate/{id_siswa}', [App\Http\Controllers\Admin\SiswaadminssController::class, 'update'])->name('datasiswaadminssupdate');
Route::get('/datasiswaadminssdelete/{id_siswa}', [App\Http\Controllers\Admin\SiswaadminssController::class, 'destroy'])->name('datasiswaadminssdestroy');

//Data Guru Admin
Route::get('dataguruadmin', [App\Http\Controllers\Admin\GuruadminController::class, 'index'])->name('dataguruadmin')->middleware('auth');
Route::post('/dataguruadminstore', [App\Http\Controllers\Admin\GuruadminController::class, 'store'])->name('dataguruadminstore');
Route::post('/dataguruadminupdate/{id_guru}', [App\Http\Controllers\Admin\GuruadminController::class, 'update'])->name('dataguruadminupdate');
Route::get('/dataguruadmindelete/{id_guru}', [App\Http\Controllers\Admin\GuruadminController::class, 'destroy'])->name('dataguruadmindestroy');

//Data Mata Pelajaran
Route::get('matpeladmin', [App\Http\Controllers\Admin\MatpeladminController::class, 'index'])->name('matpeladmin')->middleware('auth');
Route::post('/matpeladminstore', [App\Http\Controllers\Admin\MatpeladminController::class, 'store'])->name('matpeladminstore');
Route::post('/matpeladminupdate/{id_matpel}', [App\Http\Controllers\Admin\MatpeladminController::class, 'update'])->name('matpeladminupdate');
Route::get('/matpeladmindelete/{id_matpel}', [App\Http\Controllers\Admin\MatpeladminController::class, 'destroy'])->name('matpeladmindestroy');

//Data Tingkatan Kelas
Route::get('tingkeladmin', [App\Http\Controllers\Admin\TingkeladminController::class, 'index'])->name('tingkeladmin')->middleware('auth');
Route::post('/tingkeladminstore', [App\Http\Controllers\Admin\TingkeladminController::class, 'store'])->name('tingkeladminstore');
Route::post('/tingkeladminupdate/{id_tingkel}', [App\Http\Controllers\Admin\TingkeladminController::class, 'update'])->name('tingkeladminupdate');
Route::get('/tingkeladmindelete/{id_tingkel}', [App\Http\Controllers\Admin\TingkeladminController::class, 'destroy'])->name('tingkeladmindestroy');

//Data Nama Kelas
Route::get('kelasadmin', [App\Http\Controllers\Admin\KelasadminController::class, 'index'])->name('kelasadmin')->middleware('auth');
Route::post('/kelasadminstore', [App\Http\Controllers\Admin\KelasadminController::class, 'store'])->name('kelasadminstore');
Route::post('/kelasadminupdate/{id_kelas}', [App\Http\Controllers\Admin\KelasadminController::class, 'update'])->name('kelasadminupdate');
Route::get('/kelasadmindelete/{id_kelas}', [App\Http\Controllers\Admin\KelasadminController::class, 'destroy'])->name('kelasadmindestroy');

//Data Walkes Admin
Route::get('datawalkesadmin', [App\Http\Controllers\Admin\WalkesadminController::class, 'index'])->name('datawalkesadmin')->middleware('auth');
Route::post('/walkesadminstore', [App\Http\Controllers\Admin\WalkesadminController::class, 'store'])->name('walkesadminstore');
Route::post('/walkesadminupdate/{id_walkes}', [App\Http\Controllers\Admin\WalkesadminController::class, 'update'])->name('walkesadminupdate');
Route::get('/walkesadmindelete/{id_walkes}', [App\Http\Controllers\Admin\WalkesadminController::class, 'destroy'])->name('walkesadmindestroy');

//Data Orang Tua Admin
Route::get('dataortuadmin', [App\Http\Controllers\Admin\OrtuadminController::class, 'index'])->name('dataortuadmin')->middleware('auth');
Route::post('/ortuadminstore', [App\Http\Controllers\Admin\OrtuadminController::class, 'store'])->name('ortuadminstore');
Route::post('/ortuadminupdate/{id_ortu}', [App\Http\Controllers\Admin\OrtuadminController::class, 'update'])->name('ortuadminupdate');
Route::get('/ortuadmindelete/{id_ortu}', [App\Http\Controllers\Admin\OrtuadminController::class, 'destroy'])->name('ortuadmindestroy');

//Data Pembelajaran Admin
Route::get('pembelajaranadmin', [App\Http\Controllers\Admin\PembelajaranadminController::class, 'index'])->name('pembelajaranadmin')->middleware('auth');
Route::post('/pembelajaranadminstore', [App\Http\Controllers\Admin\PembelajaranadminController::class, 'store'])->name('pembelajaranadminstore');
Route::post('/pembelajaranadminupdate/{id_bel}', [App\Http\Controllers\Admin\PembelajaranadminController::class, 'update'])->name('pembelajaranadminupdate');
Route::get('/pembelajaranadmindelete/{id_bel}', [App\Http\Controllers\Admin\PembelajaranadminController::class, 'destroy'])->name('pembelajaranadmindestroy');

//Reka Data Siswa Admin
Route::get('rekadatasiswa', [App\Http\Controllers\Admin\LaporansiswaController::class, 'index'])->name('laporandatasiswa')->middleware('auth');
Route::get('/previewsiswa/{id_kelas}', [App\Http\Controllers\Admin\LaporansiswaController::class, 'filter'])->name('datasiswadmin')->middleware('auth');

//Reka Data Guru Admin
Route::get('rekadataguru', [App\Http\Controllers\Admin\LaporanguruController::class, 'index'])->name('laporandataguru')->middleware('auth');

//Reka Data Walkes Admin
Route::get('rekadatawalkes', [App\Http\Controllers\Admin\LaporanwalkesController::class, 'index'])->name('laporandatawalkes')->middleware('auth');

//Reka Data Ortu Admin
Route::get('rekadataortu', [App\Http\Controllers\Admin\LaporanortuController::class, 'index'])->name('laporandataortu')->middleware('auth');
Route::get('/previewortu/{id_kelas}', [App\Http\Controllers\Admin\LaporanortuController::class, 'filter'])->name('dataortuadminns')->middleware('auth');

//Guru
Route::get('dashboardguru', [App\Http\Controllers\Guru\DashboardguruController::class, 'index'])->name('dashboardguru')->middleware('auth');

//Data Absensi Guru
Route::get('dataabsenguru', [App\Http\Controllers\Guru\DataabsenguruController::class, 'index'])->name('dataabsenguru')->middleware('auth');
Route::get('/previewabsen/{id_bel}', [App\Http\Controllers\Guru\DataabsenguruController::class, 'filter'])->name('dataabsen');
Route::post('/dataabsengurustore', [App\Http\Controllers\Guru\DataabsenguruController::class, 'store'])->name('dataabsengurustore');
Route::post('/dataabsenguruupdate/{pertemuan}', [App\Http\Controllers\Guru\DataabsenguruController::class, 'update'])->name('dataabsenguruupdate');
Route::get('/dataabsengurudelete/{id_absensi}', [App\Http\Controllers\Guru\DataabsenguruController::class, 'destroy'])->name('dataabsengurudestroy');

//Absen Guru
Route::get('absenguru', [App\Http\Controllers\Guru\AbsenguruController::class, 'index'])->name('absenguru')->middleware('auth');
Route::get('/previewabsenguru/{id_bel}', [App\Http\Controllers\Guru\AbsenguruController::class, 'filter'])->name('absen')->middleware('auth');

//Data Nilai Guru
Route::get('datanilaiguru', [App\Http\Controllers\Guru\DatanilaiguruController::class, 'index'])->name('datanilaiguru')->middleware('auth');
Route::get('/previewnilai/{id_bel}', [App\Http\Controllers\Guru\DatanilaiguruController::class, 'filter'])->name('datanilai');
Route::post('/datanilaigurustore', [App\Http\Controllers\Guru\DatanilaiguruController::class, 'store'])->name('datanilaigurustore');
Route::post('/datanilaiguruupdate/{id_nilai}', [App\Http\Controllers\Guru\DatanilaiguruController::class, 'update'])->name('datanilaiguruupdate');
Route::get('/datanilaigurudelete/{id_nilai}', [App\Http\Controllers\Guru\DatanilaiguruController::class, 'destroy'])->name('datanilaigurudestroy');

//Rekap Data Guru
Route::get('rekapdataguru', [App\Http\Controllers\Guru\RekapguruController::class, 'index'])->name('rekapdataguru')->middleware('auth');
Route::get('/previewrekapnilai/{id_bel}', [App\Http\Controllers\Guru\RekapguruController::class, 'filter'])->name('rekapdatanilai')->middleware('auth');
Route::get('profileguru', [App\Http\Controllers\Guru\ProfileguruController::class, 'index'])->name('profileguru')->middleware('auth');
Route::post('/profileguruupdate/{id_guru}', [App\Http\Controllers\Guru\ProfileguruController::class, 'update'])->name('profileguruupdate')->middleware('auth');

//Siswa
Route::get('homesiswa', [App\Http\Controllers\Siswa\HomesiswaController::class, 'index'])->name('homesiswa')->middleware('auth');
Route::get('/transkripnilaisiswa/{id_siswa}', [App\Http\Controllers\Siswa\HomesiswaController::class, 'filter'])->name('transkripnilaisiswa')->middleware('auth');
Route::get('/absensiswa/{id_bel}', [App\Http\Controllers\Siswa\HomesiswaController::class, 'absen'])->name('absensiswa')->middleware('auth');
Route::get('profilesiswa', [App\Http\Controllers\Siswa\ProfilesiswaController::class, 'index'])->name('profilesiswa')->middleware('auth');
Route::post('/profilesiswaupdate/{id_siswa}', [App\Http\Controllers\Siswa\ProfilesiswaController::class, 'update'])->name('profilesiswaupdate');
Route::get('/daftarabsen', [App\Http\Controllers\Siswa\HomesiswaController::class, 'absensi'])->name('daftarabsen')->middleware('auth');

//Walkes
Route::get('homewalkes', [App\Http\Controllers\Walkes\HomewalkesController::class, 'index'])->name('homewalkes')->middleware('auth');
Route::get('profilewalkes', [App\Http\Controllers\Walkes\ProfilewalkesController::class, 'index'])->name('profilewalkes')->middleware('auth');
Route::post('/profilewalkesupdate/{id_walkes}', [App\Http\Controllers\Walkes\ProfilewalkesController::class, 'update'])->name('profilewalkesupdate');
Route::get('/nilaisiswawalkes/{id_walkes}', [App\Http\Controllers\Walkes\HomewalkesController::class, 'filter'])->name('nilaisiswawalkes')->middleware('auth');
Route::get('/absensiswawalkes/{id_bel}', [App\Http\Controllers\Walkes\HomewalkesController::class, 'absen'])->name('absensiswawalkes')->middleware('auth');
Route::get('absenwalkes', [App\Http\Controllers\Walkes\AbsenwalkesController::class, 'index'])->name('absenwalkes')->middleware('auth');

//Ortu
Route::get('homeortu', [App\Http\Controllers\Ortu\HomeortuController::class, 'index'])->name('homeortu')->middleware('auth');
Route::get('profileortu', [App\Http\Controllers\Ortu\ProfileortuController::class, 'index'])->name('profileortu')->middleware('auth');
Route::post('/profileortuupdate/{id_ortu}', [App\Http\Controllers\Ortu\ProfileortuController::class, 'update'])->name('profileortuupdate');
Route::get('/nilaianak/{id_ortu}', [App\Http\Controllers\Ortu\HomeortuController::class, 'filter'])->name('nilaianak')->middleware('auth');
Route::get('/absenortu/{id_bel}', [App\Http\Controllers\Ortu\HomeortuController::class, 'absen'])->name('absenortu')->middleware('auth');
Route::get('/daftarabsenortu', [App\Http\Controllers\Ortu\HomeortuController::class, 'absensi'])->name('daftarabsenortu')->middleware('auth');