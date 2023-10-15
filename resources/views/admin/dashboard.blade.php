@extends('layouts.admin.app')
@section('content')

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x" style="color: #00a000"></i>
                            <div class="ms-3">
                                <p class="mb-2">Jumlah Siswa</p>
                                <h6 class="mb-0">{{ count($siswas) }} Orang</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x" style="color: #00a000"></i>
                            <div class="ms-3">
                                <p class="mb-2">Jumlah Guru</p>
                                <h6 class="mb-0">{{ count($gurus) }} Orang</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x" style="color: #00a000"></i>
                            <div class="ms-3">
                                <p class="mb-2">Jumlah Wali Kelas</p>
                                <h6 class="mb-0">{{ count($walkes) }} Orang</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x" style="color: #00a000"></i>
                            <div class="ms-3">
                                <p class="mb-2">Jumlah Orang Tua</p>
                                <h6 class="mb-0">{{ count($ortu) }} Orang</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-3">
                        &nbsp;
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Presentase Data</h6>
                            </div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-3">
                        &nbsp;
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->

@endsection