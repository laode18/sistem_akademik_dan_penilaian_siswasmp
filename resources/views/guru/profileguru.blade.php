@extends('layouts.guru.app')
@section('content')

<!-- Home Start -->
<div class="container-fluid pt-4 px-4">
        <h4>Profile Guru</h4>
</div>
<br />
@include('layouts.messages')

<div class="container-fluid pt-4 px-4">
<center>
<div class="col-sm-12 col-xl-6">
    <div class="bg-light rounded h-100 p-4">
            @foreach ($guru as $sw)
            <div class="testimonial-item text-center">
                <img class="img-fluid rounded-circle mx-auto mb-4" src="{{ url('images/'.$sw->foto) }}" style="width: 100px; height: 100px;">
                <h5 class="mb-1">{{ $sw->nama_guru }}</h5>
                <br />
                <div class="row">
                                    <div class="col-lg-4">
                                        <p>NUPTK</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>:</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>{{ $sw->nuptk }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p>Password</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>:</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="hidetext">{{ $sw->password }}</p>
                                    </div>
                                </div>
                                <br />
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#datasiswaEdit{{ $sw->id_guru }}">Ubah</button></center>
            </div>
            @endforeach
        
    </div>
</div>
</center>
</div>
                

<!-- Edit Service Modal -->
@foreach ($guru as $sw)
    <div class="modal fade" id="datasiswaEdit{{ $sw->id_guru }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Edit Data Guru</h5>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data layanan -->
                    <form action="{{ url('/profileguruupdate', $sw->id_guru) }}" method="POST" id="editform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="passwordInputs{{ $sw->nuptk }}" value="{{ $sw->password }}" required>
                            <span class="input-group-text" onclick="togglePasswordVisibilitys{{ $sw->nuptk }}()">
                            <i id="togglePasswordIcons{{ $sw->nuptk }}" class="fa fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($guru as $sw)
    <script>
        // Tambahkan JavaScript berikut pada bagian <head> atau file JavaScript terpisah
        function togglePasswordVisibilitys{{ $sw->nuptk }}() {
        var passwordInputs = document.getElementById("passwordInputs{{ $sw->nuptk }}");
        var togglePasswordIcons = document.getElementById("togglePasswordIcons{{ $sw->nuptk }}");

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