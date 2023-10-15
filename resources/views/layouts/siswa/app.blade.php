<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sistem Informasi Absensi dan Penilaian Siswa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('images/logo.jpg')}}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{URL::asset('siswa/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('siswa/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{URL::asset('siswa/css/style.css')}}" rel="stylesheet">

    <style>
        .hidetext { -webkit-text-security: disc; /* Default */ }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light pt-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <p><i class="fa fa-home mr-2"></i>&nbsp;Sistem Informasi Absensi dan Penilaian Siswa</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <img src="{{ URL::asset('images/logo.png'); }}" width="90" height="90" alt="" />
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="/homesiswa" class="nav-item nav-link {{ set_active('homesiswa') }}">Home</a>
                        <?php 
                            $idSiswa = Auth::user()->id;

                            $nilai = DB::table('db_siswa')
                            ->join('kelas', 'db_siswa.id_kelas', '=', 'kelas.id_kelas')
                            ->where('db_siswa.id_siswa', '=', $idSiswa)
                            ->get();
                        ?>
                        <a href="/daftarabsen" class="nav-item nav-link {{ set_active(['daftarabsen', 'absensiswa']) }}">Absensi</a>
                        @foreach ($nilai as $nl)
                        <a href="{{ route('transkripnilaisiswa', ['id_siswa' => $nl->id_siswa]) }}" class="nav-item nav-link {{ set_active('transkripnilaisiswa') }}">Transkrip Nilai</a>
                        @endforeach
                        <a href="/profilesiswa" class="nav-item nav-link {{ set_active('profilesiswa') }}">Profile &nbsp;</a>
                        @foreach($nilai as $nl)
                            <img class="rounded-circle me-lg-2" class="nav-item nav-link" src="{{ url('images/'.$nl->foto) }}" alt="" style="width: 40px; height: 40px; margin-top: 1.3rem;">
                        @endforeach
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                                <a href="{{ route('actionlogout') }}" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

        <!-- Page content-->
        @yield('content')

        <!-- Footer Start -->
    
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white-50">Copyright &copy; Sistem Akademik SMP YPI Bandung</a> | All Right Reserved<?php echo " ".date("Y"); ?>.</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{URL::asset('siswa/lib/easing/easing.min.js')}}"></script>
    <script src="{{URL::asset('siswa/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{URL::asset('siswa/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{URL::asset('siswa/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{URL::asset('siswa/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{URL::asset('siswa/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{URL::asset('siswa/mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{URL::asset('siswa/js/main.js')}}"></script>
</body>

</html>