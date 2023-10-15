@extends('layouts.admin.app')
@section('content')

    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        <h4>Rekap Data Guru</h4>
    </div>
    <br />
    @include('layouts.messages')
    <?php
        $highestCount = 0; // Inisialisasi variabel untuk menyimpan angka tertinggi

        foreach($gurus as $gr) {
            $gurusss = DB::table('guru')
            ->join('pembelajaran', 'guru.id_guru', '=', 'pembelajaran.id_guru')
            ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
            ->select('guru.*', 'kelas.*')
            ->where('guru.id_guru', '=', $gr->id_guru)
            ->distinct()
            ->get();

            $count = count($gurusss);

            // Cek apakah $count lebih besar dari angka tertinggi yang sebelumnya
            if ($count > $highestCount) {
                $highestCount = $count; // Update angka tertinggi
            }
        }
    ?>

        <?php
            $highestCounts = 0; // Inisialisasi variabel untuk menyimpan angka tertinggi

            foreach($gurus as $gr) {
                $guruss = DB::table('guru')
                    ->join('pembelajaran', 'guru.id_guru', '=', 'pembelajaran.id_guru')
                    ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
                    ->select('guru.*', 'mata_pelajaran.*')
                    ->where('guru.id_guru', '=', $gr->id_guru)
                    ->distinct()
                    ->get();

                $count = count($guruss);

                // Cek apakah $count lebih besar dari angka tertinggi yang sebelumnya
                if ($count > $highestCounts) {
                    $highestCounts = $count; // Update angka tertinggi
                }
            }
        ?>

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <!-- <a class="no-print btn btn-sm btn-success" style="float: right; margin-right: 25px; font-size: 16px;" onclick="CreatePDFfromHTML()" ><span class="fa fa-download"></span> &nbsp; Download</a> -->
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#datasiswaModal"><i
                            class="fa fa-download"></i> &nbsp; Download</button>
                    </div>
                    <div class="table-responsive">
                    <div>
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark text-center" style="background-color: #abd700;">
                                    <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">NUPTK</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Foto</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Guru</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Jenis Kelamin</th>
                                    @foreach($gurus as $gr)
                                    <?php
                                        $guruss = DB::table('guru')
                                        ->join('pembelajaran', 'guru.id_guru', '=', 'pembelajaran.id_guru')
                                        ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
                                        ->select('guru.*', 'mata_pelajaran.*')
                                        ->where('guru.id_guru', '=', $gr->id_guru) // Ganti $guruId dengan ID guru yang ingin ditampilkan
                                        ->distinct()
                                        ->get();
                                    
                                    $gurusss = DB::table('guru')
                                        ->join('pembelajaran', 'guru.id_guru', '=', 'pembelajaran.id_guru')
                                        ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
                                        ->select('guru.*', 'kelas.*')
                                        ->where('guru.id_guru', '=', $gr->id_guru) // Ganti $guruId dengan ID guru yang ingin ditampilkan
                                        ->distinct()
                                        ->get();
                                    
                                    ?>@endforeach

                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Kelas</th>

                                    <th scope="col" style="text-align: center; color: #ffffff;">Mata Pelajaran</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach($gurus as $gr)
                                <tr class="text-center">
                                    <td>{{$no++}}.</td>
                                    <td>{{ $gr->nuptk }}</td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        <img src="{{ url('images/'.$gr->foto) }}" class="img-thumbnail" width="50" height="50">
                                    </td>
                                    <td>{{ $gr->nama_guru }}</td>
                                    <td>{{ $gr->jenis_kel }}</td>
                                    <?php
                                    $guruss = DB::table('guru')
                                    ->join('pembelajaran', 'guru.id_guru', '=', 'pembelajaran.id_guru')
                                    ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
                                    ->select('guru.*', 'mata_pelajaran.nama_matpel AS nama')
                                    ->where('guru.id_guru', '=', $gr->id_guru)
                                    ->distinct()
                                    ->get();

                                    $gurusss = DB::table('guru')
                                    ->join('pembelajaran', 'guru.id_guru', '=', 'pembelajaran.id_guru')
                                    ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
                                    ->select('guru.*', 'kelas.nama_kelas AS nama')
                                    ->where('guru.id_guru', '=', $gr->id_guru)
                                    ->distinct()
                                    ->get();
                                    ?>
                                    @if(count($guruss) > 0 || count($gurusss) > 0)
                                    <td>
                                        @foreach($gurusss as $gss)
                                        {{ $gss->nama }}<br>
                                        @endforeach
                                        
                                    </td>
                                    <td>
                                        @foreach($guruss as $gs)
                                        {{ $gs->nama }}<br>
                                        @endforeach
                                    </td>
                                    @else
                                    <td>-</td>
                                    <td>-</td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Home End -->
            <br /><br /><br /><br /><br />


            <!-- Add Cooperation Modal -->
            <div class="modal fade" id="datasiswaModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="serviceModalLabel">Download Data Guru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="margin-left: -15px;">
                            <!-- Isi form untuk menambah data layanan -->
                            <center>
                                <div id="halaman1" style="width: 21cm; height: 29.7cm; background-color: white;"> 
                                  <div class="header" style="display: flex; align-items: start; justify-content: space-between;">
                                    <div style="width: 30%; padding-left: 1px; padding-top: 30px;">
                                      <img src="{{URL::asset('images/logo.png')}}" style="width: 150px; height: 150px;" alt="">
                                  </div>  

                                  <div style="width: 60%; padding-top: 30px; margin-left: -70px; color: black;">
                                      <p style="font-size: 17pt; margin: 5px 0;"><b>YAYASAN PESANTREN ISLAM 'ISTAWA'</b></p>
                                      <p style="font-size: 17pt; margin: 5px 0;"><b>SEKOLAH MENENGAH PERTAMA YPI</b></p>
                                      <p style="font-size: 17pt; margin: 5px 0;"><b>(SMP-YPI)</b></p>
                                      <p style="font-size: 12pt; margin: 5px 0;">SK. Kanwil No. 02.00/311/BAP-SM/SK/X/2014</p>
                                      <p style="font-size: 12pt; margin: 5px 0;">Jalam Muhammad No. 17 Telp. 022-6070867</p>
                                  </div>    

                                  <div style="width: 10%;">

                                  </div>
                              </div>
                              <hr style="border-top: 7px double #131212; width: 90%;">
                              <div style="margin-top: 30px; text-align: center; color: black;">
                                
                                <p style="margin: 5px 0; font-size: 11pt;"><b>DATA REKAP GURU</b></p>

                                <p style="margin: 5px 0; font-size: 11pt;">TAHUN AJARAN <?php echo " ".date("Y", strtotime("-1 year")); ?> -<?php echo " ".date("Y"); ?></p>
                            </div>
                            <div style="margin-top: 30px; padding-left: 60px; padding-right: 60px;"> 

                              <table id="data-table" class="table text-start align-middle table-bordered table-hover mb-0" style="width: 100%; font-size: 11pt; line-height: 25px; border-collapse: collapse;">
                                  <thead>
                                    <tr class="text-dark text-center" style="background-color: #abd700; border-width: 1px;
                                    border-style: solid;
                                    border-color: black;"
                                    >
                                    <th scope="col" style="text-align: center; vertical-align: middle; color: white;">No.</th>
                                    <th scope="col" style="text-align: center; vertical-align: middle; color: white;">NUPTK</th>
                                    <th scope="col" style="text-align: center; vertical-align: middle; color: white;">Foto</th>
                                    <th scope="col" style="text-align: center; vertical-align: middle; color: white;">Nama Guru</th>
                                    <th scope="col" style="text-align: center; vertical-align: middle; color: white;">Jenis Kelamin</th>
                                    <th scope="col" style="text-align: center; vertical-align: middle; color: white;">Kelas</th>
                                    <th scope="col" style="text-align: center; vertical-align: middle; color: white;">Mata Pelajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $np=1; ?>
                              @foreach($gurus as $gr)
                              <tr class="text-center" style="text-align: center; background-color: white; color: black; border-width: 1px;
                              padding: 2px;
                              border-style: solid;
                              border-color: black;"
                              >
                              <td>{{$np++}}.</td>
                              <td>{{ $gr->nuptk }}</td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        <img src="{{ url('images/'.$gr->foto) }}" class="img-thumbnail" width="50" height="50">
                                    </td>
                                    <td>{{ $gr->nama_guru }}</td>
                                    <td>{{ $gr->jenis_kel }}</td>
                                    <?php
                                    $guruss = DB::table('guru')
                                    ->join('pembelajaran', 'guru.id_guru', '=', 'pembelajaran.id_guru')
                                    ->join('mata_pelajaran', 'pembelajaran.id_matpel', '=', 'mata_pelajaran.id_matpel')
                                    ->select('guru.*', 'mata_pelajaran.nama_matpel AS nama')
                                    ->where('guru.id_guru', '=', $gr->id_guru)
                                    ->distinct()
                                    ->get();

                                    $gurusss = DB::table('guru')
                                    ->join('pembelajaran', 'guru.id_guru', '=', 'pembelajaran.id_guru')
                                    ->join('kelas', 'pembelajaran.id_kelas', '=', 'kelas.id_kelas')
                                    ->select('guru.*', 'kelas.nama_kelas AS nama')
                                    ->where('guru.id_guru', '=', $gr->id_guru)
                                    ->distinct()
                                    ->get();
                                    ?>
                                    @if(count($guruss) > 0 || count($gurusss) > 0)
                                    <td>
                                        @foreach($gurusss as $gss)
                                        {{ $gss->nama }}<br>
                                        @endforeach
                                        
                                    </td>
                                    <td>
                                        @foreach($guruss as $gs)
                                        {{ $gs->nama }}<br>
                                        @endforeach
                                    </td>
                                    @else
                                    <td>-</td>
                                    <td>-</td>
                                    @endif
                        </tr>
                        @endforeach
                    </tbody>  
                </table>

            </div>
      <!-- <div style="display: flex; flex: column; justify-content: space-between; margin-top: 70px; color: black;">
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <?php 
        function getCurrentDateIndonesia() {
            $monthNames = array(
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                );

            $currentDate = date("d") . " " . $monthNames[date("n") - 1] . " " . date("Y");
            return $currentDate;
        }

            // Contoh penggunaan:
        $currentDate = getCurrentDateIndonesia();
        ?>
        <div style="text-align: center; padding-right: 100px; margin-left: 60%; position: relative; line-height: 15px;">
          <p style="margin: 5px 0; font-size: 11pt;">Bandung, <?php echo $currentDate; ?></p>
          <p style="margin: 5px 0; font-size: 11pt;">Guru Mata Pelajaran</p>
          <br />
          <p style="margin: 5px 0; font-size: 11pt; margin-top: 70px;"><u><b>{{ ucwords(Auth::user()->name) }}</b></u></p>
          <p style="margin: 5px 0; font-size: 11pt;"><b>{{ ucwords(Auth::user()->email) }}</b></p>
      </div>
  </div> -->
</div>

</center>

</div>
<div class="modal-footer">
    <button id="download-button" class="btn btn-secondary">Download Excel</button>
    <button onclick="CreatePDFfromHTML()" class="btn btn-danger">Download Pdf</button>
</div>
</div>
</div>
</div>

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
        pdf.save("dataguru.pdf");
    });
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fungsi untuk mengonversi tabel ke CSV
        function tableToCSV($table) {
            var csv = [];
            $table.find('tr').each(function() {
                var row = [];
                $(this).find('th,td').each(function() {
                    if ($(this).is('td')) {
                        var img = $(this).find('img');
                        if (img.length > 0) {
                            row.push(img.attr('src')); // Menyisipkan URL gambar ke dalam CSV
                        } else {
                            row.push($(this).text());
                        }
                    } else {
                        row.push($(this).text());
                    }
                });
                csv.push(row.join(','));
            });
            return csv.join('\n');
        }

        // Menggunakan jQuery untuk menangani klik pada tombol
        $('#download-button').click(function() {
            var csvContent = tableToCSV($('#data-table'));
            var blob = new Blob([csvContent], { type: 'text/csv' });
            var url = URL.createObjectURL(blob);

            // Membuat elemen anchor untuk mengunduh
            var a = document.createElement('a');
            a.href = url;
            a.download = 'rekapdataguru.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        });
    });
</script>
        
@endsection