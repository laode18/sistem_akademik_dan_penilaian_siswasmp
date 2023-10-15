@extends('layouts.guru.app')
@section('content')

<!-- Home Start -->
<div class="container-fluid pt-4 px-4">
        <h4>Data Absensi Kelas</h4>
    </div>
    <br />

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        @foreach($absensis as $ab)
        <div class="col-xl-6">
            <div class="bg-light rounded d-flex align-items-center" style="padding: 2rem;">
                <i class="fa fa-chart-line fa-3x" style="color: #00a000"></i>
                <div style="margin-left: 3rem;">
                    <p class="mb-2">{{ $ab->nama_matpel }}</p>
                    <h6 class="mb-0">{{ $ab->nama_kelas }}</h6>
                </div>
                <div class="ms-auto">
                    <a class="btn btn-success" href="{{ route('absen', ['id_bel' => $ab->id_bel]) }}">Cek</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<br />
<br />
<br />
<br />

@endsection