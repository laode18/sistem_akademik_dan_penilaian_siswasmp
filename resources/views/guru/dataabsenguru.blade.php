@extends('layouts.guru.app')

@section('content')

    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        <h4>Input Absensi {{ $filteredAbsensisss[0]->nama_matpel }} Kelas {{ $filteredAbsensisss[0]->nama_kelas }}</h4>
    </div>
    <br />
    @include('layouts.messages')

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
    <form action="{{ route('dataabsengurustore') }}" method="POST" id="editformss" enctype="multipart/form-data">
        @csrf
        @foreach($pem as $pm)
            <input type="text" name="id_bel" class="form-control" value="{{ $pm->id_bel }}" required hidden>
        @endforeach
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center mb-4">
                <div class="form-group">
                    <label class="fw-bold" style="color: #abd700; margin-left: -45px">Pilih Pertemuan</label>
                    <select name="pertemuan" id="pertemuanSelect" class="form-select" required onchange="filterTable()">
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
                <td>
                <div class="form-group" style="margin-left: 20px">
                        <label class="fw-bold" style="color: #abd700; margin-left: -110px">Tanggal</label>
                        <div class="input-group">
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>
                </td>
                <td>
                <div class="form-group" style="margin-left: 20px; margin-top: 21px;">
                    <label class="fw-bold" style="color: #abd700; margin-left: -61px;">Pokok Pembahasan</label>
                    
                    <div class="input-group" style="width: 200%;">
                        <textarea name="pokok_pembahasan" type="text" class="form-control"></textarea>
                    </div>
                    
                </div>

                </td>
            </div>
            <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark text-center" style="background-color: #abd700;">
                        <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
                        <th scope="col" style="text-align: center; color: #ffffff;">Nama Siswa</th>
                        <th scope="col" style="text-align: center; color: #ffffff;">Hadir</th>
                        <th scope="col" style="text-align: center; color: #ffffff;">Sakit</th>
                        <th scope="col" style="text-align: center; color: #ffffff;">Izin</th>
                        <th scope="col" style="text-align: center; color: #ffffff;">Alpa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach($filteredAbsensisss as $filteredAb)
                    <tr class="text-center">
                        <td>{{$no++}}.</td>
                        <td>
                            <input type="text" name="nama_siswa[]" value="{{ $filteredAb->id_siswa }}" hidden>
                            {{ $filteredAb->nama_siswa }}
                        </td>
                        <td><input type="checkbox" class="attendance-checkbox" name="hadir[{{ $filteredAb->id_siswa }}]" value="1"></td>
                        <td><input type="checkbox" class="attendance-checkbox" name="sakit[{{ $filteredAb->id_siswa }}]" value="1"></td>
                        <td><input type="checkbox" class="attendance-checkbox" name="izin[{{ $filteredAb->id_siswa }}]" value="1"></td>
                        <td><input type="checkbox" class="attendance-checkbox" name="alpa[{{ $filteredAb->id_siswa }}]" value="1"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <br />
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
        </form>
    </div>
    <!-- Home End -->
    <br />

    <div class="container-fluid pt-4 px-4">
        <h4>Cek Absensi {{ $filteredAbsensisss[0]->nama_matpel }} Kelas {{ $filteredAbsensisss[0]->nama_kelas }}</h4>
    </div>

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
        @foreach($filteredAbsensiss as $filteredAbs)
        <form action="{{ url('/dataabsenguruupdate', $filteredAbs->pertemuan) }}" method="POST" id="editform">
        @endforeach
    @csrf
    <div class="d-flex align-items-center mb-4">
        <td>
            <div class="form-group">
                <label class="fw-bold" style="color: #abd700; margin-left: -110px">Tanggal</label>
                <div class="input-group">
                    <input type="date" name="tanggal" id="tanggalInput" class="form-control" required>
                    <input type="hidden" name="tanggal_hidden" id="tanggalHidden">
                </div>
            </div>
        </td>
        <td>
            <div class="form-group" style="margin-left: 20px; margin-top: 21px;">
                <label class="fw-bold" style="color: #abd700; margin-left: -61px;">Pokok Pembahasan</label>
                <div class="input-group" style="width: 200%;">
                    <textarea name="pokok_pembahasan" type="text" id="pokokPembahasanInput" class="form-control"></textarea>
                    <input type="hidden" name="pokok_pembahasan_hidden" id="pokokPembahasanHidden">
                </div>
            </div>
        </td>
    </div>

            <div class="table-responsive">
                <table id="myTabled" class="table text-start align-middle table-bordered table-hover mb-0">
    <thead>
        <tr class="text-dark text-center" style="background-color: #abd700;">
            <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
            <th scope="col" style="text-align: center; color: #ffffff;">Nama Siswa</th>
            <th scope="col" style="text-align: center; color: #ffffff;">Pertemuan</th>
            <th scope="col" style="text-align: center; color: #ffffff;">Hadir</th>
            <th scope="col" style="text-align: center; color: #ffffff;">Sakit</th>
            <th scope="col" style="text-align: center; color: #ffffff;">Izin</th>
            <th scope="col" style="text-align: center; color: #ffffff;">Alpa</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; 
                $totals = [];
                $np = 1;
        ?>
        @if(isset($filteredAbsensiss) && $filteredAbsensiss->count() > 0)
        @foreach($filteredAbsensiss as $key => $filteredAbs)

        <tr id="asep" class="text-center">
            <td>{{$no++}}.</td>
            <td>
                <input type="text" name="id_absen[]" value="{{ $filteredAbs->id_absensi }}" hidden>
                <input type="text" name="nama_siswa[]" value="{{ $filteredAbs->id_siswa }}" hidden>
                {{ $filteredAbs->nama_siswa }}
            </td>
            <td>{{ $filteredAbs->pertemuan }}</td>
            <td class="status-column">
                <input name="hadir[{{ $filteredAbs->id_absensi }}]" class="attendance-checkbox" type="checkbox" value="1" @if($filteredAbs->hadir == 1) checked @endif>
            </td>
            <td class="status-column">
                <input name="sakit[{{ $filteredAbs->id_absensi }}]" class="attendance-checkbox" type="checkbox" value="1" @if($filteredAbs->sakit == 1) checked @endif>
            </td>
            <td class="status-column">
                <input name="izin[{{ $filteredAbs->id_absensi }}]" class="attendance-checkbox" type="checkbox" value="1" @if($filteredAbs->izin == 1) checked @endif>
            </td>
            <td class="status-column">
                <input name="alpa[{{ $filteredAbs->id_absensi }}]" class="attendance-checkbox" type="checkbox" value="1" @if($filteredAbs->alpa == 1) checked @endif>
            </td>

        </tr>
        <?php
            // Menghitung jumlah total hadir, izin, sakit, dan alpa berdasarkan nama_siswa
            $namaSiswa = $filteredAbs->nama_siswa;
            if (!isset($totals[$namaSiswa])) {
                $totals[$namaSiswa] = [
                    'hadir' => 0,
                    'izin' => 0,
                    'sakit' => 0,
                    'alpa' => 0,
                ];
            }

            if ($filteredAbs->hadir == 1) {
                $totals[$namaSiswa]['hadir']++;
            }
            if ($filteredAbs->izin == 1) {
                $totals[$namaSiswa]['izin']++;
            }
            if ($filteredAbs->sakit == 1) {
                $totals[$namaSiswa]['sakit']++;
            }
            if ($filteredAbs->alpa == 1) {
                $totals[$namaSiswa]['alpa']++;
            }
        ?>
    @endforeach

    <!-- Menambahkan baris total untuk setiap siswa -->
    @foreach($totals as $namaSiswa => $total)
        <tr id="totalRow" class="text-center">
            <td>{{$np++}}.</td>
            <td>{{ $namaSiswa }}</td>
            <td>Total</td>
            <td>{{ $total['hadir'] }}</td>
            <td>{{ $total['sakit'] }}</td>
            <td>{{ $total['izin'] }}</td>
            <td>{{ $total['alpa'] }}</td>
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
            <br />
            <button type="submit" class="btn btn-success">Edit</button>
        </div>
        </form>
    </div>

    <br />
    <br />
    <br />
    <br />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    <script>
        $('#datepicker').datepicker({
            format: "dd-mm-yyyy",
            uiLibrary: 'bootstrap4'
        });
    </script>

    <script>
    // Mendapatkan semua elemen checkbox dengan class "attendance-checkbox"
    const checkboxes = document.querySelectorAll('.attendance-checkbox');

    // Menambahkan event listener untuk setiap checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Jika checkbox ini dicentang, maka nonaktifkan semua checkbox lain di baris yang sama
            if (this.checked) {
                const row = this.closest('tr'); // Mendapatkan elemen <tr> yang mengandung checkbox ini
                const otherCheckboxes = row.querySelectorAll('.attendance-checkbox');
                otherCheckboxes.forEach(otherCheckbox => {
                    if (otherCheckbox !== this) {
                        otherCheckbox.disabled = true;
                    }
                });
            } else {
                // Jika checkbox ini tidak dicentang, aktifkan kembali semua checkbox lain di baris yang sama
                const row = this.closest('tr');
                const otherCheckboxes = row.querySelectorAll('.attendance-checkbox');
                otherCheckboxes.forEach(otherCheckbox => {
                    otherCheckbox.disabled = false;
                });
            }
        });
    });
</script>


<script>
    document.getElementById('editform').addEventListener('submit', function () {
        let checkboxes = document.querySelectorAll('.attendance-checkbox');
        checkboxes.forEach(function (checkbox) {
            if (!checkbox.checked) {
                checkbox.value = 0;
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    
    function filterTable() {
        var selectedPertemuan = document.querySelector('select[name="pertemuan"]').value;
        var tableRows = document.querySelectorAll('#myTabled tbody tr');
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

        var editForms = document.querySelectorAll('#editform');

        editForms.forEach(function (form) {
            form.action = '{{ url('/dataabsenguruupdate') }}/' + selectedPertemuan;
        });
    }

    // Panggil filterTable saat halaman dimuat untuk pertama kali
    window.addEventListener('load', filterTable);
</script>

<script type="text/javascript">
    $(document).ready(function() {
    // Fungsi untuk mengatur nilai "Tanggal" dan "Pokok Pembahasan" saat pertemuan dipilih
    $('#pertemuanSelect').on('change', function() {
        var selectedPertemuan = $(this).val();

        // Cari data absensi yang sesuai dengan pertemuan yang dipilih
        var filteredAbsensi = @json($filteredAbsensiss).find(function (absensi) {
            return absensi.pertemuan == selectedPertemuan;
        });

        // Setel nilai "Tanggal" dan "Pokok Pembahasan" sesuai dengan data yang ditemukan
        if (filteredAbsensi) {
            $('#tanggalInput').val(filteredAbsensi.tanggal);
            $('#pokokPembahasanInput').val(filteredAbsensi.pokok_pembahasan);
        } else {
            $('#tanggalInput').val(''); // Kosongkan jika tidak ada data yang sesuai
            $('#pokokPembahasanInput').val('');
        }
    });

    // Panggil fungsi di atas saat halaman dimuat untuk pertama kali
    $('#pertemuanSelect').trigger('change');
});

</script>

@endsection
