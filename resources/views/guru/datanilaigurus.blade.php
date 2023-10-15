@extends('layouts.guru.app')

@section('content')

    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        @if(count($filteredAbsensiss) > 0)
            <h4>Data Nilai {{ $filteredAbsensiss[0]->nama_matpel }} Kelas {{ $filteredAbsensiss[0]->nama_kelas }}</h4>
        @else
            <h4>Data Nilai</h4>
        @endif
    </div>
    <br />
    @include('layouts.messages')

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center mb-4">
                <div class="dropdown">
                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Data Kelas
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        @foreach($absensis as $ab)
                            <li><a class="dropdown-item" href="{{ route('datanilai', ['id_bel' => $ab->id_bel]) }}">{{ $ab->nama_matpel }} ({{ $ab->nama_kelas }})</a></li>
                        @endforeach
                    </ul>
                </div>
                <td>
                    <button class="btn btn-sm btn-success" style="margin-left: 2rem;" data-bs-toggle="modal" data-bs-target="#dataabsenAdd"><i class="fa fa-plus"></i>&nbsp; Input Data</button>
                </td>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark text-center" style="background-color: #abd700;">
                            <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Nama Siswa</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Ulangan Harian</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Tugas</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">UTS</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">UAS</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Absensi</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Nilai</th>
                            <th scope="col" style="text-align: center; color: #ffffff;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                            @if(isset($filteredAbsensiss) && $filteredAbsensiss->count() > 0)
                                @foreach($filteredAbsensiss as $filteredAb)
                                        <tr class="text-center">
                                            <?php
                                                $rata_ulangan_harian = round(((($filteredAb->ulangan_harian + $filteredAb->ulangan_harian1 + $filteredAb->ulangan_harian2 + $filteredAb->ulangan_harian3) / 4)), 2);

                                                $rata_tugas = round(((($filteredAb->tugas + $filteredAb->tugas1) / 2)), 2);

                                                $rata_nilai = round(((($rata_ulangan_harian + $rata_tugas + $filteredAb->uts + $filteredAb->uas + $filteredAb->nilai_absen) / 5)), 2);
                                            ?>
                                            <td>{{$no++}}.</td>
                                            <td>{{ $filteredAb->nama_siswa }}</td>
                                            <td>{{ $rata_ulangan_harian }}</td>
                                            <td>{{ $rata_tugas }}</td>
                                            <td>{{ $filteredAb->uts }}</td>
                                            <td>{{ $filteredAb->uas }}</td>
                                            <td>{{ $filteredAb->nilai_absen }}</td>
                                            <td>{{ $rata_nilai }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#datanilaiEdit{{ $filteredAb->id_nilai }}"><i class="fa fa-pen"></i></button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteNilaisiswa{{ $filteredAb->id_nilai }}"><i class="fa fa-trash"></i></button>
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
    <!-- Home End -->
    <br />
    <br />
    <br />

    @if(isset($filteredAbsensis) && $filteredAbsensis->count() > 0)
    
    <!-- Add Cooperation Modal -->
<div class="modal fade" id="dataabsenAdd" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Tambah Data Nilai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menambah data layanan -->
                <form action="{{ route('datanilaigurustore') }}" method="POST" id="editform" enctype="multipart/form-data">
                    @csrf
                    @foreach($pem as $pm)
                    <input type="text" name="id_bel" class="form-control" value="{{ $pm->id_bel }}" required hidden>
                    @endforeach
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Siswa</label>
                        <select name="id_siswa" class="form-select" required>
                            <option value="" hidden>Nama Siswa</option>
                            @foreach($filteredAbsensis as $filteredAb)
                                <option value="{{ $filteredAb->id_siswa }}">{{ $filteredAb->nama_siswa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nilai Ulangan Harian 1</label>
                        <input type="number" name="ulangan_harian" class="form-control" placeholder="Nilai Ulangan Harian 1" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nilai Ulangan Harian 2</label>
                        <input type="number" name="ulangan_harian1" class="form-control" placeholder="Nilai Ulangan Harian 2" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nilai Ulangan Harian 3</label>
                        <input type="number" name="ulangan_harian2" class="form-control" placeholder="Nilai Ulangan Harian 3" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nilai Ulangan Harian 4</label>
                        <input type="number" name="ulangan_harian3" class="form-control" placeholder="Nilai Ulangan Harian 4" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nilai Tugas 1</label>
                        <input type="number" name="tugas" class="form-control" placeholder="Nilai Tugas 1" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nilai Tugas 2</label>
                        <input type="number" name="tugas1" class="form-control" placeholder="Nilai Tugas 2" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nilai Absen</label>
                        <input type="number" name="nilai_absen" class="form-control" placeholder="Nilai Absen" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nilai UTS</label>
                        <input type="number" name="uts" class="form-control" placeholder="Nilai UTS" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nilai UAS</label>
                        <input type="number" name="uas" class="form-control" placeholder="Nilai UAS" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" required></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Edit Service Modal -->
@foreach ($filteredAbsensiss as $ab)
    <div class="modal fade" id="datanilaiEdit{{ $ab->id_nilai }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Edit Data Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data layanan -->
                    <form action="{{ url('/datanilaiguruupdate', $ab->id_nilai) }}" method="POST" id="editform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="text" name="id_bel" class="form-control" value="{{ $ab->id_bel }}" required hidden>
                        <input type="text" name="id_siswa" class="form-control" value="{{ $ab->id_siswa }}" required hidden>
                        <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Siswa</label>
                        <input type="text" class="form-control" value="{{ $ab->nama_siswa }}" required disabled>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Ulangan Harian 1</label>
                        <input type="number" name="ulangan_harian" class="form-control" value="{{ $ab->ulangan_harian }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Ulangan Harian 2</label>
                        <input type="number" name="ulangan_harian1" class="form-control" value="{{ $ab->ulangan_harian1 }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Ulangan Harian 3</label>
                        <input type="number" name="ulangan_harian2" class="form-control" value="{{ $ab->ulangan_harian2 }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Ulangan Harian 4</label>
                        <input type="number" name="ulangan_harian3" class="form-control" value="{{ $ab->ulangan_harian3 }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Tugas 1</label>
                        <input type="number" name="tugas" class="form-control" value="{{ $ab->tugas }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Tugas 2</label>
                        <input type="number" name="tugas1" class="form-control" value="{{ $ab->tugas1 }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nilai Absen</label>
                        <input type="number" name="nilai_absen" class="form-control" value="{{ $ab->nilai_absen }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">UTS</label>
                        <input type="number" name="uts" class="form-control" value="{{ $ab->uts }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">UAS</label>
                        <input type="number" name="uas" class="form-control" value="{{ $ab->uas }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" required>{{ $ab->deskripsi }}</textarea>
                    </div>


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
    <div id="deleteNilaisiswa{{ $ab->id_nilai }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">   
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 "><div class="row"><div class="col ml-auto"></div> </div>
                        <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p><p class="text-muted "> These changes will be visible on your portal and the data will be deleted.</p>     </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0"> 
                            <div class="row justify-content-end no-gutters"><div class="col-auto"><button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button> &nbsp; <a class="btn btn-danger px-4" href="/datanilaigurudelete/{{ $ab->id_nilai }}" role="button">Delete</a></div><div class="col-auto"></div></div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    @endforeach


@endsection
