@extends('layouts.admin.app')
@section('content')

    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        <h4>Data Orang Tua</h4>
    </div>
    <br />
    @include('layouts.messages')

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                    <td><button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#dataortuModal"><i
                        class="fa fa-plus"></i> Tambah Data</button></td>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark text-center" style="background-color: #abd700;">
                                    <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Orang Tua</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Anak/Siswa</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Alamat</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Username</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Password</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach ($ortus as $rt)
                                <tr class="text-center">
                                    <td>{{$no++}}.</td>
                                    <td>{{ $rt->nama_ortu }}</td>
                                    <td>{{ $rt->nama_siswa }}</td>
                                    <td>{{ $rt->alamat }}</td>
                                    <td>{{ $rt->username }}</td>
                                    <td class="hidetext">{{ $rt->password }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#dataortuEdit{{ $rt->id_ortu }}"><i class="fa fa-pen"></i></button> &nbsp;
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDataortu{{ $rt->id_ortu }}"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="dataortuModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Tambah Data Orang Tua</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menambah data layanan -->
                <form action="{{ route('ortuadminstore') }}" method="POST" id="editform" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id_ortu" class="form-control" value="ORT-{{$no++}}" required hidden>
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Orang Tua</label>
                        <input type="text" name="nama_ortu" class="form-control" placeholder="Nama Orang Tua" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Anak/Siswa</label>
                        <select name="id_siswa" class="form-select" required>
                            <option value="" hidden>Nama Anak/Siswa</option>
                            @foreach ($siswas as $sw)
                                <option value="{{ $sw->id_siswa }}">{{ $sw->nama_siswa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Alamat</label>
                        <textarea type="text" name="alamat" rows="5" placeholder="Alamat" class="form-control" required></textarea>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
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
@foreach ($ortus as $rt)
    <div class="modal fade" id="dataortuEdit{{ $rt->id_ortu }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Edit Data Orang Tua</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data layanan -->
                    <form action="{{ url('/ortuadminupdate', $rt->id_ortu) }}" method="POST" id="editform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Orang Tua</label>
                        <input type="text" name="nama_ortu" class="form-control" value="{{ $rt->nama_ortu }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Anak/Siswa</label>
                        <select name="id_siswa" class="form-select" required>
                            @foreach ($siswas as $sw)
                                <option value="{{ $sw->id_siswa }}" {{ old('id_siswa', $rt->id_siswa) == $sw->id_siswa ? 'selected' : null}}>{{ $sw->nama_siswa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Alamat</label>
                        <textarea type="text" name="alamat" rows="5" class="form-control" required>{{ $rt->alamat }}</textarea>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $rt->username }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" value="{{ $rt->password }}" class="form-control" id="passwordInputs{{ $rt->username }}" required>
                            <span class="input-group-text" onclick="togglePasswordVisibilitys{{ $rt->username }}()">
                            <i id="togglePasswordIcons{{ $rt->username }}" class="fa fa-eye-slash"></i>
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
    @foreach ($ortus as $rt)
    <div id="deleteDataortu{{ $rt->id_ortu }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">   
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 "><div class="row"><div class="col ml-auto"></div> </div>
                        <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p><p class="text-muted "> These changes will be visible on your portal and the data will be deleted.</p>     </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0"> 
                            <div class="row justify-content-end no-gutters"><div class="col-auto"><button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button> &nbsp; <a class="btn btn-danger px-4" href="/ortuadmindelete/{{ $rt->id_ortu }}" role="button">Delete</a></div><div class="col-auto"></div></div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($ortus as $rt)
    <script>
        // Tambahkan JavaScript berikut pada bagian <head> atau file JavaScript terpisah
        function togglePasswordVisibilitys{{ $rt->username }}() {
        var passwordInputs = document.getElementById("passwordInputs{{ $rt->username }}");
        var togglePasswordIcons = document.getElementById("togglePasswordIcons{{ $rt->username }}");

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