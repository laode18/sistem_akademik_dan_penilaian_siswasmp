@extends('layouts.ortu.app')
@section('content')

    <!-- About Start -->
    <div class="container-fluid" style=" margin-top: -2rem;">
        <div class="container-fluid">
            <div class="row">
            <div class="col-lg-4" style="min-height: 500px;">
                    
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                        <h3 class="mb-3">Hasil Studi</h3>
                        <br />
                        @foreach($filteredAbsensistr as $filteredAbg)
                        <div class="col-lg-6" style="margin-left: -1rem;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>Nama Siswa</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>:</p>
                                    </div>
                                    <div class="col-lg-4">
                                        <p>{{ $filteredAbg->nama_siswa }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>NIS</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>:</p>
                                    </div>
                                    <div class="col-lg-4">
                                        <p>{{ $filteredAbg->nisn }}</p>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                        <div class="table-responsive">
                        <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark text-center" style="background-color: #abd700;">
                                <th scope="col" style="text-align: center; color: #ffffff; vertical-align: middle">No.</th>
                                    <th scope="col" style="text-align: center; color: #ffffff; vertical-align: middle">Nama Mata Pelajaran</th>
                                    <th scope="col" style="text-align: center; color: #ffffff; vertical-align: middle">Nilai</th>
                                    <th scope="col" style="text-align: center; color: #ffffff; vertical-align: middle">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                                @foreach($filteredAbsensiss as $filteredAb)
                                <tr class="text-center">
                                    <td style="vertical-align: middle;">{{$no++}}.</td>
                                    <td style="vertical-align: middle;">{{ $filteredAb->nama_matpel }}</td>
                                    <td style="vertical-align: middle;">{{ number_format($filteredAb->rata_nilai, 2) }}</td>
                                    <td style="text-align: justify;">{{ $filteredAb->deskripsi }}</td>
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

@endsection    