@extends('layouts.ortu.app')
@section('content')

<div class="container">
<!-- Home Start -->
<div class="container-fluid pt-4 px-4">
        <h4>Data Absensi Kelas</h4>
    </div>
    <br />
    @foreach($filteredAbsensistr as $filteredAbg)
    <div class="col-lg-6" style="margin-left: 1rem; text-align: left;">
        <div class="row">
            <div class="col-lg-4">
                <p>Nama Siswa</p>
            </div>
            <div class="col-lg-2">
                <p>:</p>
            </div>
            <div class="col-lg-6">
                <p>{{ $filteredAbg->nama_siswa }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <p>NIS</p>
            </div>
            <div class="col-lg-2">
                <p>:</p>
            </div>
            <div class="col-lg-6">
                <p>{{ $filteredAbg->nisn }}</p>
            </div>
        </div>
    </div>
    @endforeach

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        @foreach($absensis as $ab)
        <div class="col-xl-6" style="margin-bottom: 20px;">
            <div class="bg-light rounded d-flex align-items-center" style="padding: 2rem;">
                <i class="fa fa-chart-line fa-3x" style="color: #00a000"></i>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 70%;">
                            <div style="margin-left: 3rem;">
                                <p class="mb-2">{{ $ab->nama_matpel }}</p>
                                <h6 class="mb-0">{{ $ab->nama_kelas }}</h6>
                            </div>
                        </td>
                        <td style="width: 30%;">
                            <div>
                                <a class="btn btn-success" href="{{ route('absenortu', ['id_bel' => $ab->id_bel]) }}">Cek</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
<br />
<br />
<br />
<br />

@endsection