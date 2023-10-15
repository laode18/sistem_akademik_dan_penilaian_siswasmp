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
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Home</h6>
                        <h1 class="mb-3">Selamat Datang {{ Auth::user()->name }}</h1>
                        <br />
                        <p style="text-align: justify;">Ini merupakan sistem yang memberikan layanan informasi terkait indeks kemampuan dan penilain terhadap peserta didik / siswa yang bersekolah di SMP YPI Bandung</p>
                        <div class="row mb-4">
                            <div class="col-6">
                                <img class="img-fluid" src="img/about-1.jpg" alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="img/about-2.jpg" alt="">
                            </div>
                        </div>
                        <center>
                        <a href="" class="btn btn-primary mt-1">Cek Nilai</a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

@endsection    