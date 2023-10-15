@extends('layouts.admin.app')
@section('content')

    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        <h4>Data Guru</h4>
    </div>
    <br />
    @include('layouts.messages')

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                    <td><button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#dataguruModal"><i
                        class="fa fa-plus"></i> Tambah Data</button></td>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark text-center" style="background-color: #abd700;">
                                    <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">NUPTK</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Foto</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Guru</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Jenis Kelamin</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Password</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach ($gurus as $gr)
                                <tr class="text-center">
                                    <td>{{$no++}}.</td>
                                    <td>{{ $gr->nuptk }}</td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        <img src="{{ url('images/'.$gr->foto) }}" class="img-thumbnail" width="150" height="150">
                                    </td>
                                    <td>{{ $gr->nama_guru }}</td>
                                    <td>{{ $gr->jenis_kel }}</td>
                                    <td class="hidetext">{{ $gr->password }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#dataguruEdit{{ $gr->id_guru }}"><i class="fa fa-pen"></i></button> <br /><br />
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDataguru{{ $gr->id_guru }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Home End -->
            <br /><br /><br /><br /><br />

    <!-- Add Cooperation Modal -->
<div class="modal fade" id="dataguruModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Tambah Data Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menambah data layanan -->
                <form action="{{ route('dataguruadminstore') }}" method="POST" id="editform" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id_guru" class="form-control" value="GR-{{$no++}}" required hidden>
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">NUPTK</label>
                        <input type="text" name="nuptk" class="form-control" placeholder="NUPTK" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Guru</label>
                        <input type="text" name="nama_guru" class="form-control" placeholder="Nama Guru" required>
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
@foreach ($gurus as $gr)
    <div class="modal fade" id="dataguruEdit{{ $gr->id_guru }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Edit Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data layanan -->
                    <form action="{{ url('/dataguruadminupdate', $gr->id_guru) }}" method="POST" id="editform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">NUPTK</label>
                        <input type="text" name="nuptk" class="form-control" value="{{ $gr->nuptk }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Foto</label>
                        <input type="file" name="foto" class="form-control" value="{{ $gr->foto }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Guru</label>
                        <input type="text" name="nama_guru" class="form-control" value="{{ $gr->nama_guru }}" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Jenis Kelamin</label>
                        <select name="jenis_kel" class="form-select" required>
                            <option value="{{ $gr->jenis_kel }}" hidden>{{ $gr->jenis_kel }}</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="passwordInputs{{ $gr->nuptk }}" value="{{ $gr->password }}" required>
                            <span class="input-group-text" onclick="togglePasswordVisibilitys{{ $gr->nuptk }}()">
                            <i id="togglePasswordIcons{{ $gr->nuptk }}" class="fa fa-eye-slash"></i>
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
    @foreach ($gurus as $gr)
    <div id="deleteDataguru{{ $gr->id_guru }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">   
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 "><div class="row"><div class="col ml-auto"></div> </div>
                        <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p><p class="text-muted "> These changes will be visible on your portal and the data will be deleted.</p>     </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0"> 
                            <div class="row justify-content-end no-gutters"><div class="col-auto"><button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button> &nbsp; <a class="btn btn-danger px-4" href="/dataguruadmindelete/{{ $gr->id_guru }}" role="button">Delete</a></div><div class="col-auto"></div></div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($gurus as $gr)
    <script>
        // Tambahkan JavaScript berikut pada bagian <head> atau file JavaScript terpisah
        function togglePasswordVisibilitys{{ $gr->nuptk }}() {
        var passwordInputs = document.getElementById("passwordInputs{{ $gr->nuptk }}");
        var togglePasswordIcons = document.getElementById("togglePasswordIcons{{ $gr->nuptk }}");

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