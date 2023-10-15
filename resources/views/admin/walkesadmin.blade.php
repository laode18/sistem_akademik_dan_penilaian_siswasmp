@extends('layouts.admin.app')
@section('content')

    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        <h4>Data Wali Kelas</h4>
    </div>
    <br />
    @include('layouts.messages')

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                    <td><button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#datawalkesModal"><i
                        class="fa fa-plus"></i> Tambah Data</button></td>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark text-center" style="background-color: #abd700;">
                                    <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Email</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Foto</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Wali Kelas</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Jenis Kelamin</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Kelas</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Password</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach ($walkes as $wk)
                                <tr class="text-center">
                                    <td>{{$no++}}.</td>
                                    <td>{{ $wk->nuptk }}</td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        <img src="{{ url('images/'.$wk->foto) }}" class="img-thumbnail" width="150" height="150">
                                    </td>
                                    <td>{{ $wk->nama_walkes }}</td>
                                    <td>{{ $wk->jenis_kel }}</td>
                                    <td>{{ $wk->nama_kelas }}</td>
                                    <td class="hidetext">{{ $wk->password }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#datawalkesEdit{{ $wk->id_walkes }}"><i class="fa fa-pen"></i></button> <br /><br />
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDatawalkes{{ $wk->id_walkes }}"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="datawalkesModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Tambah Data Wali Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menambah data layanan -->
                <form action="{{ route('walkesadminstore') }}" method="POST" id="editform" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id_walkes" class="form-control" value="WK-{{$no++}}" required hidden>
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Email</label>
                        <input type="email" name="nuptk" class="form-control" placeholder="Email" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Wali Kelas</label>
                        <input type="text" name="nama_walkes" class="form-control" placeholder="Nama Wali Kelas" required>
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
@foreach ($walkes as $wk)
    <div class="modal fade" id="datawalkesEdit{{ $wk->id_walkes }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Edit Data Wali Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data layanan -->
                    <form action="{{ url('/walkesadminupdate', $wk->id_walkes) }}" method="POST" id="editform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Email</label>
                        <input type="email" name="nuptk" class="form-control" value="{{ $wk->nuptk }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Foto</label>
                        <input type="file" name="foto" class="form-control" value="{{ $wk->foto }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Guru</label>
                        <input type="text" name="nama_walkes" class="form-control" value="{{ $wk->nama_walkes }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Jenis Kelamin</label>
                        <select name="jenis_kel" class="form-select" required>
                            <option value="{{ $wk->jenis_kel }}" hidden>{{ $wk->jenis_kel }}</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Kelas</label>
                        <select name="id_kelas" class="form-select" required>
                            @foreach ($kelas as $kl)
                                <option value="{{ $kl->id_kelas }}" {{ old('id_kelas', $wk->id_kelas) == $kl->id_kelas ? 'selected' : null}}>{{ $kl->nama_kelas }}</option>
                            @endforeach
                        </select>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Delete Service Modal -->
    @foreach ($walkes as $wk)
    <div id="deleteDatawalkes{{ $wk->id_walkes }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">   
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 "><div class="row"><div class="col ml-auto"></div> </div>
                        <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p><p class="text-muted "> These changes will be visible on your portal and the data will be deleted.</p>     </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0"> 
                            <div class="row justify-content-end no-gutters"><div class="col-auto"><button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button> &nbsp; <a class="btn btn-danger px-4" href="/walkesadmindelete/{{ $wk->id_walkes }}" role="button">Delete</a></div><div class="col-auto"></div></div>
                        </div>
                    </div>  
                </div>
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