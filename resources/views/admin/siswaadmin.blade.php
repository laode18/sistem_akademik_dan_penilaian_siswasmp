@extends('layouts.admin.app')
@section('content')

    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        <h4>Data Siswa Kelas 7</h4>
    </div>
    <br />
    @include('layouts.messages')

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                    <td><button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#datasiswaModal"><i
                        class="fa fa-plus"></i> Tambah Data</button></td>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark text-center" style="background-color: #abd700;">
                                    <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">NISN</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Foto</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Siswa</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Jenis Kelamin</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Kelas</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Tanggal Lahir</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Password</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach ($siswas as $sw)
                                <tr class="text-center">
                                    <td>{{$no++}}.</td>
                                    <td>{{ $sw->nisn }}</td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        <img src="{{ url('images/'.$sw->foto) }}" class="img-thumbnail" width="150" height="150">
                                    </td>
                                    <td>{{ $sw->nama_siswa }}</td>
                                    <td>{{ $sw->jenis_kel }}</td>
                                    <td>{{ $sw->nama_kelas }}</td>
                                    <td>{{ $sw->tanggal_lahir }}</td>
                                    <td class="hidetext">{{ $sw->password }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#datasiswaEdit{{ $sw->id_siswa }}"><i class="fa fa-pen"></i></button> <br /><br />
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDatasiswa{{ $sw->id_siswa }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Home End -->

    <!-- Add Cooperation Modal -->
<div class="modal fade" id="datasiswaModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menambah data layanan -->
                <form action="{{ route('datasiswaadminstore') }}" method="POST" id="editform" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id_siswa" class="form-control" value="SW7-{{$no++}}" required hidden>
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">NISN</label>
                        <input type="text" name="nisn" class="form-control" placeholder="NISN" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control" placeholder="Nama Siswa" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Jenis Kelamin</label>
                        <select name="jenis_kel" class="form-select" required>
                            <option value="" hidden>Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <br />
                    
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Kelas</label>
                        <select name="id_kelas" class="form-select" required>
                            <option value="" hidden>Nama Kelas</option>
                            @foreach ($kelas as $kl)
                                <option value="{{ $kl->id_kelas }}">{{ $kl->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                    <label class="fw-bold" style="color: #abd700;">Tanggal Lahir</label>
                        <div class="input-group">
                            <input type="text" id="datepicker" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" required>
                            <span class="input-group-text"><i class="fa fa-calendar"></i><span>
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password" required>
                            <span class="input-group-text" onclick="togglePasswordVisibility()">
                            <i id="togglePasswordIcon" class="fa fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Service Modal -->
@foreach ($siswas as $sw)
    <div class="modal fade" id="datasiswaEdit{{ $sw->id_siswa }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Edit Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data layanan -->
                    <form action="{{ url('/datasiswaadminupdate', $sw->id_siswa) }}" method="POST" id="editform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">NISN</label>
                        <input type="text" name="nisn" class="form-control" value="{{ $sw->nisn }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control" value="{{ $sw->nama_siswa }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Jenis Kelamin</label>
                        <select name="jenis_kel" class="form-select" required>
                            <option value="{{ $sw->jenis_kel }}" hidden>{{ $sw->jenis_kel }}</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Kelas</label>
                        <select name="id_kelas" class="form-select" required>
                            @foreach ($kelas as $kl)
                                <option value="{{ $kl->id_kelas }}" {{ old('id_kelas', $sw->id_kelas) == $kl->id_kelas ? 'selected' : null}}>{{ $kl->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Tanggal Lahir</label>
                        <div class="input-group">
                            <input type="text" id="datepicker{{ $sw->nisn }}" name="tanggal_lahir" class="form-control" value="{{ $sw->tanggal_lahir }}" required>
                            <span class="input-group-text"><i class="fa fa-calendar"></i><span>
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="passwordInputs{{ $sw->nisn }}" value="{{ $sw->password }}" required>
                            <span class="input-group-text" onclick="togglePasswordVisibilitys{{ $sw->nisn }}()">
                            <i id="togglePasswordIcons{{ $sw->nisn }}" class="fa fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Delete Service Modal -->
    @foreach ($siswas as $sw)
    <div id="deleteDatasiswa{{ $sw->id_siswa }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">   
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 "><div class="row"><div class="col ml-auto"></div> </div>
                        <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p><p class="text-muted "> These changes will be visible on your portal and the data will be deleted.</p>     </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0"> 
                            <div class="row justify-content-end no-gutters"><div class="col-auto"><button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button> &nbsp; <a class="btn btn-danger px-4" href="/datasiswaadmindelete/{{ $sw->id_siswa }}" role="button">Delete</a></div><div class="col-auto"></div></div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($siswas as $sw)
    <script>
        // Tambahkan JavaScript berikut pada bagian <head> atau file JavaScript terpisah
        function togglePasswordVisibilitys{{ $sw->nisn }}() {
        var passwordInputs = document.getElementById("passwordInputs{{ $sw->nisn }}");
        var togglePasswordIcons = document.getElementById("togglePasswordIcons{{ $sw->nisn }}");

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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    <script>
        $('#datepicker').datepicker({
            format: "dd-mm-yyyy",
            uiLibrary: 'bootstrap4'
        });
    </script>

    @foreach ($siswas as $sw)
    <script>
        $('#datepicker{{ $sw->nisn }}').datepicker({
            format: "dd-mm-yyyy",
            uiLibrary: 'bootstrap4'
        });
    </script>
    @endforeach

@endsection