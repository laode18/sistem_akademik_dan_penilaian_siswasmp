@extends('layouts.walkes.app')

@section('content')

    <!-- About Start -->
    <div class="container-fluid" style="margin-top: -2rem;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4" style="min-height: 500px;">
                <?php
function tentukanPredikat($nilai) {
    if ($nilai >= 80 && $nilai <= 100) {
        return 'A';
    } elseif ($nilai >= 60 && $nilai < 80) {
        return 'B';
    } elseif ($nilai >= 40 && $nilai < 60) {
        return 'C';
    } elseif ($nilai >= 20 && $nilai < 40) {
        return 'D';
    } elseif ($nilai >= 0 && $nilai < 20) {
        return 'E';
    } else {
        return 'Nilai tidak valid';
    }
}
?>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5" style="width: 1100px; margin-left: -300px;">
                        <h3 class="mb-3">Hasil Studi Siswa</h3>
                        <br />
                        <div class="table-responsive">
                            <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark text-center" style="background-color: #abd700;">
                                        <th scope="col" rowspan="2" style="vertical-align: middle; text-align: center; color: #ffffff;">No.</th>
                                        <th scope="col" rowspan="2" style="vertical-align: middle; text-align: center; color: #ffffff;">Rapor</th>
                                        <th scope="col" rowspan="2" style="vertical-align: middle; text-align: center; color: #ffffff;">Nama Siswa</th>
                                        <th scope="colgroup" colspan="{{ count($filteredAbsensisd) }}" style="text-align: center; color: #ffffff;">Mata Pelajaran</th>
                                        
                                    </tr>
                                    <tr class="text-dark text-center" style="background-color: #abd700;">
                                    @foreach($filteredAbsensisd->unique('id_matpel') as $filteredAbs)
                                            <th scope="col" style="vertical-align: middle; text-align: center; color: #ffffff;">{{ $filteredAbs->nama_matpel }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($filteredAbsensiss as $filteredAb)
                                        <tr class="text-center">
                                            <td>{{$no++}}.</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" style="border-radius: 10px;" data-toggle="modal"
                                                    data-target="#datasiswaEdit{{ $filteredAb->id_siswa }}"
                                                    >&nbsp;&nbsp;Cek&nbsp;&nbsp;</button>
                                            </td>

                                            <td>{{ $filteredAb->nama_siswa }}</td>
                                            @foreach($filteredAbsensisd->unique('id_matpel') as $filteredAbs)
                                                <?php $nilai = $filteredAbsensisd->where('id_siswa', $filteredAb->id_siswa)->where('id_matpel', $filteredAbs->id_matpel)->first(); ?>
                                                <td>
                                                    @if ($nilai && is_numeric($nilai->rata_nilai))
                                                        {{ number_format(floatval($nilai->rata_nilai), 2) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    @foreach($filteredAbsensisd as $filteredAbs)
    <!-- Edit Service Modal -->
    <div class="modal fade" id="datasiswaEdit{{ $filteredAbs->id_siswa }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Rapor Siswa</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                </div>

                <div class="modal-body" style="margin-left: -15px;">
                    <!-- Isi form untuk menambah data layanan -->
                    <center>
                        <div id="halaman1" style="width: 21cm; height: 29.7cm; background-color: white;"> 
                            <div class="header" style="display: flex; align-items: start; justify-content: space-between;">
                                <div style="width: 60%; padding-left: 30px; padding-top: 20px;">
                                    <table style="font-size: 11pt; color: black; font-weight: 100;">
                                        <tr width="200%">
                                            <th width="35%">Nama Sekolah</th>
                                            <th width="5%">:</th>
                                            <th width="95%">SMP YPI Bandung</th>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <th>:</th>
                                            <th>Jl. Muhammad No. 17 Bandung</th>
                                        </tr>
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <th>:</th>
                                            <th>{{ $filteredAbs->nama_siswa }}</th>
                                        </tr>
                                        <tr>
                                            <th>NISN</th>
                                            <th>:</th>
                                            <th>{{ $filteredAbs->nisn }}</th>
                                        </tr>
                                    </table>
                                </div>  

                                <div style="width: 10%; padding-top: 20px; margin-left: -70px; color: black;">
                                    
                                </div>    

                                <div style="width: 50%; padding-top: 20px; margin-right: -20px;">
                                <table style="font-size: 11pt; color: black; font-weight: 100;">
                                        <tr width="200%">
                                            <th width="57%">Kelas</th>
                                            <th width="8%">:</th>
                                            <th width="95%">{{ $filteredAbs->nama_kelas }}</th>
                                        </tr>
                                        <tr>
                                            <th>Semester</th>
                                            <th>:</th>
                                            <th>1</th>
                                        </tr>
                                        <tr>
                                            <th>Tahun Ajaran</th>
                                            <th>:</th>
                                            <th><?php echo " ".date("Y", strtotime("-1 year")); ?> -<?php echo " ".date("Y"); ?></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr style="border-top: 2px double #131212; width: 90%;">
                            <div style="margin-top: 30px; padding-left: 60px; padding-right: 60px;"> 

                        <table id="data-table" class="table text-start align-middle table-bordered table-hover mb-0" style="width: 100%; font-size: 11pt; line-height: 25px; border-collapse: collapse;">
                          <thead>
                            <tr class="text-dark text-center" style="background-color: #abd700; border-width: 1px;
                            border-style: solid;
                            border-color: black;"
                            >
                            <th scope="col" style="text-align: center; color: white;">No.</th>
                            <th scope="col" style="text-align: center; color: white;">Mata Pelajaran</th>
                            <th scope="col" style="text-align: center; color: white;">Nilai</th>
                            <th scope="col" style="text-align: center; color: white;">Predikat</th>
                            <th scope="col" style="text-align: center; color: white;">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$np=1;
$id_siswa = $filteredAbs->id_siswa;
$filteredAbsensisq = DB::table('db_siswa')
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
?>

@foreach($filteredAbsensisq as $filteredAbss)
    <tr class="text-center" style="text-align: center; background-color: white; color: black; border-width: 1px;
    padding: 2px;
    border-style: solid;
    border-color: black;"
    >
    <td>{{$np++}}.</td>
    <td>{{ $filteredAbss->nama_matpel }}</td>
    <td>{{ number_format($filteredAbss->rata_nilai, 2) }}</td>
    <?php 
        $nilai = $filteredAbss->rata_nilai;
    ?>
    <td>{{ tentukanPredikat($nilai) }}</td>
    <td>{{ $filteredAbss->deskripsi }}</td>
</tr>
@endforeach

              </tbody>  
          </table>

      </div>
      <div style="display: flex; flex: column; justify-content: space-between; margin-top: 70px; color: black;">
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <?php $today = date("d F Y"); ?>
        <div style="text-align: center; padding-right: 100px; margin-left: 60%; position: relative; line-height: 15px;">
          <p style="margin: 5px 0; font-size: 11pt;">Bandung, <?php echo $today; ?></p>
          <p style="margin: 5px 0; font-size: 11pt;">Guru Mata Pelajaran</p>
          <br />
          <p style="margin: 5px 0; font-size: 11pt; margin-top: 70px;"><u><b>{{ ucwords(Auth::user()->name) }}</b></u></p>
      </div>
  </div>
      
                        </div>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button onclick="CreatePDFfromHTML()" class="btn btn-success">Download</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <textarea id="printing-css" style="display:none;">html,body,halaman1.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="#" style="display:none;"></iframe>

<script type="text/javascript">
    function printDiv(elementId) {
       var a = document.getElementById('printing-css').value;
       var b = document.getElementById(elementId).innerHTML;
       window.frames["print_frame"].document.title = document.title;
       window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
       window.frames["print_frame"].window.focus();
       window.frames["print_frame"].window.print();
   }
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script type="text/javascript">
  //Create PDf from HTML...
  function CreatePDFfromHTML() {
    var HTML_Width = $("#halaman1").width();
    var HTML_Height = $("#halaman1").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#halaman1")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("nilaisiswa.pdf");
    });
}
</script>

@endsection
