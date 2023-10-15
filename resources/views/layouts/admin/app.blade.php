<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sistem Informasi Absensi dan Penilaian Siswa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('images/logo.jpg')}}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{URL::asset('assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">

    <link href='https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css' rel='stylesheet' />
    <style>
        .hidetext { -webkit-text-security: disc; /* Default */ }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="/dashboard" class="navbar-brand mb-4" style="margin-left: 4rem; margin-top: 3rem; position: sticky;">
                    <img src="{{ URL::asset('images/logo.png'); }}" width="120" height="120" alt="" />
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="ms-3">
                        <h6 class="mb-0" style="margin-left: 1rem; color: #abd700;">Sistem Akademik</h6>
                        <span style="margin-left: 3.5rem; color: #abd700;">{{ ucwords(Auth::user()->level) }}</span>
                    </div>
                </div>
                
                <div class="navbar-nav w-100">
                    <a href="/dashboard" class="nav-item nav-link {{ set_active('dashboard') }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ set_active(['datasiswaadmin', 'datasiswaadmins', 'datasiswaadminss']) }}" data-bs-toggle="dropdown"><i class="fa fa-child me-2"></i>Data Siswa</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/datasiswaadminkelas7" class="dropdown-item nav-item nav-link {{ set_active('datasiswaadmin') }}">Kelas 7</a>
                            <a href="/datasiswaadminkelas8" class="dropdown-item nav-item nav-link {{ set_active('datasiswaadmins') }}">Kelas 8</a>
                            <a href="/datasiswaadminkelas9" class="dropdown-item nav-item nav-link {{ set_active('datasiswaadminss') }}">Kelas 9</a>
                        </div>
                    </div>
                    <a href="/dataguruadmin" class="nav-item nav-link {{ set_active('dataguruadmin') }}"><i class="fa fa-user me-2"></i>Data Guru</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ set_active(['matpeladmin', 'tingkeladmin', 'kelasadmin']) }}" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Data Master</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/matpeladmin" class="dropdown-item nav-item nav-link {{ set_active('matpeladmin') }}">Mata Pelajaran</a>
                            <a href="/kelasadmin" class="dropdown-item nav-item nav-link {{ set_active('kelasadmin') }}">Nama Kelas</a>
                        </div>
                    </div>
                    <a href="/pembelajaranadmin" class="nav-item nav-link {{ set_active('pembelajaranadmin') }}"><i class="fa fa-id-badge me-2"></i>Pembelajaran</a>
                    <a href="/datawalkesadmin" class="nav-item nav-link {{ set_active('datawalkesadmin') }}"><i class="fa fa-th me-2"></i>Data Wali Kelas</a>
                    <a href="/dataortuadmin" class="nav-item nav-link {{ set_active('dataortuadmin') }}"><i class="fa fa-user-circle me-2"></i>Data Orang Tua</a>
                    <!-- <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a> -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ set_active(['laporandatasiswa', 'laporandataguru', 'laporandatawalkes', 'laporandataortu']) }}" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Rekap Data</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/rekadatasiswa" class="dropdown-item nav-item nav-link {{ set_active('laporandatasiswa') }}">Siswa</a>
                            <a href="/rekadataguru" class="dropdown-item nav-item nav-link {{ set_active('laporandataguru') }}">Guru</a>
                            <a href="/rekadatawalkes" class="dropdown-item nav-item nav-link {{ set_active('laporandatawalkes') }}">Wali Kelas</a>
                            <a href="/rekadataortu" class="dropdown-item nav-item nav-link {{ set_active('laporandataortu') }}">Orang Tua</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="/dashboard" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><img src="{{ URL::asset('images/logo.png'); }}" width="40" height="40" alt="" /></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars" style="color: #abd700;"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color: #abd700;">
                            <img class="rounded-circle me-lg-2" src="{{ URL::asset('images/user1.png')}}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex" style="color: #abd700;">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ route('actionlogout') }}" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

        <!-- Page content-->
        @yield('content')

        </div>
        <!-- Content End -->
        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4" style="bottom: 0; position: absolute;">
                <div class="bg-light rounded-top p-4" style="margin-left: 250px;">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="/dashboard" style="color: #abd700;">Sistem Akademik SMP YPI Bandung</a> | All Right Reserved<?php echo " ".date("Y"); ?>.
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->

        <!-- Back to Top
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" id="back-to-top"><i class="bi bi-arrow-up"></i></a> -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{URL::asset('assets/lib/chart/chart.min.js')}}"></script>
    <script src="{{URL::asset('assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{URL::asset('assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{URL::asset('assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{URL::asset('assets/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{URL::asset('assets/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{URL::asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{URL::asset('assets/js/main.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatable.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    
    <script>
        // Tambahkan JavaScript berikut pada bagian <head> atau file JavaScript terpisah
        function togglePasswordVisibility() {
        var passwordInput = document.getElementById("passwordInput");
        var togglePasswordIcon = document.getElementById("togglePasswordIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePasswordIcon.classList.remove("fa-eye-slash");
            togglePasswordIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            togglePasswordIcon.classList.remove("fa-eye");
            togglePasswordIcon.classList.add("fa-eye-slash");
        }
        }
    </script>

<script>
        // Tambahkan JavaScript berikut pada bagian <head> atau file JavaScript terpisah
        function togglePasswordVisibilitys() {
        var passwordInputs = document.getElementById("passwordInputs");
        var togglePasswordIcons = document.getElementById("togglePasswordIcons");

        if (passwordInputs.type === "password") {
            passwordInputs.type = "text";
            togglePasswordIcons.classList.remove("fa-eye-slash");
            togglePasswordIcons.classList.add("fa-eye");
        } else {
            passwordInputs.type = "password";
            togglePasswordIcons.classList.remove("fa-eye");
            togglePasswordIcons.classList.add("fa-eye-slash");
        }
        }
    </script>

    
<?php 
        $siswas = DB::table('db_siswa')->get();
        $gurus = DB::table('guru')->get();
        $walkes = DB::table('wali_kelas')->get();
        $ortu = DB::table('orang_tua')->get();
    ?>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Total Siswa", "Total Guru", "Total Wali Kelas", "Total Orang Tua"],
				datasets: [{
					label: 'Presentase Jumlah',
					data: [
                    {{ count($siswas) }}, 
					{{ count($gurus) }}, 
					{{ count($walkes) }}, 
					{{ count($ortu) }}],
					backgroundColor: [
					'#00a000',
					'#00a000',
					'#00a000',
					'#00a000'
					],
					borderColor: [
					'#00a000',
					'#00a000',
					'#00a000',
					'#00a000'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});    
</script>

</body>

</html>