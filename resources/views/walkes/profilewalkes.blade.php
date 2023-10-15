@extends('layouts.walkes.app')
@section('content')

    <!-- About Start -->
    <div class="container-fluid" style=" margin-top: -2rem;">
        <div class="container-fluid">
            <div class="row">
            <div class="col-lg-4" style="min-height: 500px;">
                    
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                    @include('layouts.messages')
                        <h3 class="mb-3">Profile Wali Kelas</h3>
                        <br />
                        @foreach ($walkes as $wk)
                        <div class="row">
                            <div class="col-lg-4">
                                <center><img src="{{ url('images/'.$wk->foto) }}" width="120" height="120" alt="" /></center>
                            </div>
                            <div class="col-lg-6" style="padding-left: 4rem;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>Nama</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>:</p>
                                    </div>
                                    <div class="col-lg-4">
                                        <p>{{ $wk->nama_walkes }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>NUPTK</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>:</p>
                                    </div>
                                    <div class="col-lg-4">
                                        <p>{{ $wk->nuptk }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>Password</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>:</p>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="hidetext">{{ $wk->password }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <br />
                        <center>
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#datasiswaEdit{{ $wk->id_walkes }}">Ubah</button></center>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Edit Service Modal -->
    @foreach ($walkes as $wk)
    <div class="modal fade" id="datasiswaEdit{{ $wk->id_walkes }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Edit Data Siswa</h5>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data layanan -->
                    <form action="{{ url('/profilewalkesupdate', $wk->id_walkes) }}" method="POST" id="editform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="passwordInputs{{ $wk->nuptk }}" value="{{ $wk->password }}" required>
                            <span class="input-group-text" onclick="togglePasswordVisibilitys{{ $wk->nuptk }}()">
                            <i id="togglePasswordIcons{{ $wk->nuptk }}" class="fa fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($walkes as $wk)
    <script>
        // Tambahkan JavaScript berikut pada bagian <head> atau file JavaScript terpisah
        function togglePasswordVisibilitys{{ $wk->nuptk }}() {
        var passwordInputs = document.getElementById("passwordInputs{{ $wk->nuptk }}");
        var togglePasswordIcons = document.getElementById("togglePasswordIcons{{ $wk->nuptk }}");

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
    @endforeach

@endsection    