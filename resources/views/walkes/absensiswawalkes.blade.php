@extends('layouts.walkes.app')

@section('content')

<div class="container">
    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        <h4>Data Absensi Kelas</h4>
    </div>
    <br />
    @include('layouts.messages')

    <!-- @if ($filteredAbsensiss->isNotEmpty())
    <p>Data Terlama: {{ $filteredAbsensiss->min('pertemuan') }}</p>
    <p>Data Terbaru: {{ $filteredAbsensiss->max('pertemuan') }}</p>
@endif -->


    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center mb-4">
            <div class="form-group">
                    <label class="fw-bold" style="color: #abd700; margin-left: 5px; margin-right: 10px;">Pilih Pertemuan :</label>
                    <select name="pertemuan" class="form-select" required onchange="filterTable()">
                        <option value="" hidden>Pilih Pertemuan</option>
                            <option value="Semua">Semua Pertemuan</option>
                            <option value="1">Pertemuan 1</option>
                            <option value="2">Pertemuan 2</option>
                            <option value="3">Pertemuan 3</option>
                            <option value="4">Pertemuan 4</option>
                            <option value="5">Pertemuan 5</option>
                            <option value="6">Pertemuan 6</option>
                            <option value="7">Pertemuan 7</option>
                            <option value="8">Pertemuan 8</option>
                            <option value="9">Pertemuan 9</option>
                            <option value="10">Pertemuan 10</option>
                            <option value="11">Pertemuan 11</option>
                            <option value="12">Pertemuan 12</option>
                            <option value="13">Pertemuan 13</option>
                            <option value="14">Pertemuan 14</option>
                            <option value="15">Pertemuan 15</option>
                            <option value="16">Pertemuan 16</option>
                        </select>
                    </div>
                
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark text-center" style="background-color: #abd700;">
                            <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Nama Siswa</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Pertemuan</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Tanggal</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Pembahasan</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Hadir</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Sakit</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Izin</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Alpa</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; $totals = []; $np = 1; ?>
                            @if(isset($filteredAbsensiss) && $filteredAbsensiss->count() > 0)
                            @foreach($filteredAbsensiss as $filteredAb)
                                <tr class="text-center">
                                    <td>{{$no++}}.</td>
                                    <td>{{ $filteredAb->nama_siswa }}</td>
                                    <td>{{ $filteredAb->pertemuan }}</td>
                                    <td>{{ $filteredAb->tanggal }}</td>
                                    <td>{{ $filteredAb->pokok_pembahasan }}</td>
                                    <td>
                                        @if($filteredAb->hadir == 1)
                                            <i class="fa fa-check-circle text-success"></i>
                                        @else
                                            <i class="fa fa-times-circle text-danger"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if($filteredAb->sakit == 1)
                                            <i class="fa fa-check-circle text-success"></i>
                                        @else
                                            <i class="fa fa-times-circle text-danger"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if($filteredAb->izin == 1)
                                            <i class="fa fa-check-circle text-success"></i>
                                        @else
                                            <i class="fa fa-times-circle text-danger"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if($filteredAb->alpa == 1)
                                            <i class="fa fa-check-circle text-success"></i>
                                        @else
                                            <i class="fa fa-times-circle text-danger"></i>
                                        @endif
                                    </td>
                                    <!-- <td>
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#dataabsenEdit{{ $filteredAb->id_absensi }}"><i class="fa fa-pen"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAbsensiswa{{ $filteredAb->id_absensi }}"><i class="fa fa-trash"></i></button>
                                    </td> -->
                                </tr>
                                <?php
                                $earliestDate = min([$filteredAb->pertemuan]);
                                $latestDate = max([$filteredAb->pertemuan]);
            // Menghitung jumlah total hadir, izin, sakit, dan alpa berdasarkan nama_siswa
            $namaSiswa = $filteredAb->nama_siswa;
            if (!isset($totals[$namaSiswa])) {
                $totals[$namaSiswa] = [
                    'hadir' => 0,
                    'izin' => 0,
                    'sakit' => 0,
                    'alpa' => 0,
                ];
            }

            if ($filteredAb->hadir == 1) {
                $totals[$namaSiswa]['hadir']++;
            }
            if ($filteredAb->izin == 1) {
                $totals[$namaSiswa]['izin']++;
            }
            if ($filteredAb->sakit == 1) {
                $totals[$namaSiswa]['sakit']++;
            }
            if ($filteredAb->alpa == 1) {
                $totals[$namaSiswa]['alpa']++;
            }
        ?>
    @endforeach

    <!-- Menambahkan baris total untuk setiap siswa -->
    @foreach($totals as $namaSiswa => $total)
        <tr id="totalRow" class="text-center">
            <td style="vertical-align: middle;">{{$np++}}.</td>
            <td style="vertical-align: middle;">{{ $namaSiswa }}</td>
            @if ($filteredAbsensiss->isNotEmpty())
            <td style="vertical-align: middle;">{{ $filteredAbsensiss->min('pertemuan') }} Sampai {{ $filteredAbsensiss->max('pertemuan') }}</td>
            @endif
            @if ($filteredAbsensiss->isNotEmpty())
            <td style="vertical-align: middle;">{{ $filteredAbsensiss->min('tanggal') }} Sampai {{ $filteredAbsensiss->max('tanggal') }}</td>
            @endif
            <td style="vertical-align: middle;">Keseluruhan Pertemuan</td>
            <td style="vertical-align: middle;">{{ $total['hadir'] }}</td>
            <td style="vertical-align: middle;">{{ $total['sakit'] }}</td>
            <td style="vertical-align: middle;">{{ $total['izin'] }}</td>
            <td style="vertical-align: middle;">{{ $total['alpa'] }}</td>
        </tr>
    @endforeach

                            @else
                                <tr class="text-center">
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>
                                        -
                                    </td>
                                </tr>
                            @endif
                    </tbody>
               </table>
            </div>
        </div>
    </div>
</div>
    <!-- Home End -->
    <br />
    <br />
    <br /><br /><br />

<!-- Edit Service Modal -->
@foreach ($filteredAbsensiss as $ab)
    <div class="modal fade" id="dataabsenEdit{{ $ab->id_absensi }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Edit Data Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data layanan -->
                    <form action="{{ url('/dataabsenguruupdate', $ab->id_absensi) }}" method="POST" id="editform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="text" name="id_bel" class="form-control" value="{{ $ab->id_bel }}" required hidden>
                        <input type="text" name="id_siswa" class="form-control" value="{{ $ab->id_siswa }}" required hidden>
                        <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Siswa</label>
                        <input type="text" class="form-control" value="{{ $ab->nama_siswa }}" required disabled>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Hadir</label>
                        <input type="number" name="hadir" class="form-control" value="{{ $ab->hadir }}">
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Sakit</label>
                        <input type="number" name="sakit" class="form-control" value="{{ $ab->sakit }}">
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Izin</label>
                        <input type="number" name="izin" class="form-control" value="{{ $ab->izin }}">
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Alpa</label>
                        <input type="number" name="alpa" class="form-control" value="{{ $ab->alpa }}">
                    </div>
                    <br />


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach


    <!-- Delete Service Modal -->
    @foreach ($filteredAbsensiss as $ab)
    <div id="deleteAbsensiswa{{ $ab->id_absensi }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">   
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 "><div class="row"><div class="col ml-auto"></div> </div>
                        <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p><p class="text-muted "> These changes will be visible on your portal and the data will be deleted.</p>     </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0"> 
                            <div class="row justify-content-end no-gutters"><div class="col-auto"><button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button> &nbsp; <a class="btn btn-danger px-4" href="/dataabsengurudelete/{{ $ab->id_absensi }}" role="button">Delete</a></div><div class="col-auto"></div></div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Fungsi untuk memfilter data tabel berdasarkan pertemuan yang dipilih
        function filterTable() {
            var selectedPertemuan = document.querySelector('select[name="pertemuan"]').value;
            var tableRows = document.querySelectorAll('#myTable tbody tr');
            var no = 1;

            tableRows.forEach(function (row) {
            var pertemuanCell = row.querySelector('td:nth-child(3)');
            if (selectedPertemuan === 'Semua') {
                if (row.id === 'totalRow') {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
            }
            else if (pertemuanCell.textContent.trim() === selectedPertemuan ) {
                row.style.display = 'table-row';
                row.querySelector('td:first-child').textContent = no++;
            } else {
                row.style.display = 'none';
            }
        });
        }

        // Panggil filterTable saat halaman dimuat untuk pertama kali
        window.addEventListener('load', filterTable);
    </script>

@endsection
