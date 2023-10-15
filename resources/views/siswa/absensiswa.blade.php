@extends('layouts.siswa.app')

@section('content')

<div class="container">
    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        @if(count($filteredAbsensiss) > 0)
        <h4>Data Absensi {{ $filteredAbsensiss[0]->nama_matpel }} Kelas {{ $filteredAbsensiss[0]->nama_kelas }}</h4>
        @else
            <h4>Data Absensi</h4>
        @endif
    </div>
    <br />
    @include('layouts.messages')

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center mb-4">
            <div class="form-group" hidden>
                    <label class="fw-bold" style="color: #abd700; margin-left: 5px; margin-right: 10px;">Pilih Pertemuan :</label>
                    <select name="pertemuan" class="form-select" required onchange="filterTable()">
                        <option value="" hidden>Pilih Pertemuan</option>
                            <option value="Semua" selected>Semua Pertemuan</option>
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
                            <th scope="col" style="text-align: center; color: #ffffff;">Tanggal</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Pertemuan</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Pembahasan</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Hadir</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Sakit</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Izin</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Alpa</th>
                            
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                            @if(isset($filteredAbsensiss) && $filteredAbsensiss->count() > 0)
                            @foreach($filteredAbsensiss as $filteredAb)
                                <tr class="text-center">
                                    <td>{{$no++}}.</td>
                                    <td>{{ $filteredAb->tanggal }}</td>
                                    <td>{{ $filteredAb->pertemuan }}</td>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Fungsi untuk memfilter data tabel berdasarkan pertemuan yang dipilih
        function filterTable() {
            var selectedPertemuan = document.querySelector('select[name="pertemuan"]').value;
            var tableRows = document.querySelectorAll('#myTable tbody tr');

            tableRows.forEach(function (row) {
                var pertemuanCell = row.querySelector('td:nth-child(3)');
                if (pertemuanCell.textContent.trim() === selectedPertemuan || selectedPertemuan === 'Semua') {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Panggil filterTable saat halaman dimuat untuk pertama kali
        window.addEventListener('load', filterTable);
    </script>

@endsection
