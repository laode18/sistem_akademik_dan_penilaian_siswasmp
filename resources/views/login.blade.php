@extends('layouts.login.app')
@section('content')
    <div class="container"><br>
        <br />
        <center><img src="{{ URL::asset('images/logo.png'); }}" width="150" height="150" alt="" /></center>
        <h1 class="text-center"><b>&nbsp; Sistem Informasi Absensi dan Penilaian Siswa</b></h1>
                <br/>
             <br/>
             <h3 align="center"><b>Selamat Datang</b></h3>
        <div class="col-md-4 col-md-offset-4">
            <hr>
            @if(session('error'))
            <div class="alert alert-danger">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif
            <form action="{{ route('actionlogin') }}" method="post">
            @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="email" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="password-input-container">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
                        <span class="toggle-password" onclick="togglePasswordVisibility()"><i id="password-icon" class="fa fa-eye-slash"></i></span>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="checkbox">
                        <label><input type="checkbox" name="remember"> Remember Me</label>
                    </div>
                </div>
                <button style="background-color: #abd700; color: white;" type="submit" class="btn btn-block">Log In</button>
                <hr>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordIcon = document.getElementById("password-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.classList.remove("fa-eye-slash");
                passwordIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                passwordIcon.classList.remove("fa-eye");
                passwordIcon.classList.add("fa-eye-slash");
            }
        }
    </script>
@endsection