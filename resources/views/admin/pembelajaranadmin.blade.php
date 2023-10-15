@extends('layouts.admin.app')
@section('content')

    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        <h4>Data Pembelajaran</h4>
    </div>
    <br />
    @include('layouts.messages')

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                    <td><button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#datapembelajaranModal"><i
                        class="fa fa-plus"></i> Tambah Data</button></td>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark text-center" style="background-color: #abd700;">
                                    <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Guru</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Nama Kelas</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Mata Pelajaran</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach ($pembelajarans as $pb)
                                <tr class="text-center">
                                    <td>{{$no++}}.</td>
                                    <td>{{ $pb->nama_guru }}</td>
                                    <td>{{ $pb->nama_kelas }}</td>
                                    <td>{{ $pb->nama_matpel }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#datapembelajaranEdit{{ $pb->id_bel }}"><i class="fa fa-pen"></i></button>&nbsp;
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDatapembelajaran{{ $pb->id_bel }}"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="datapembelajaranModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Tambah Data Pembelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menambah data layanan -->
                <form action="{{ route('pembelajaranadminstore') }}" method="POST" id="editform" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id_bel" class="form-control" value="BEL{{$no++}}" required hidden>
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Guru</label>
                        <select name="id_guru" class="form-select" required>
                            <option value="" hidden>Nama Guru</option>
                            @foreach ($gurus as $gr)
                                <option value="{{ $gr->id_guru }}">{{ $gr->nama_guru }}</option>
                            @endforeach
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
                        <label class="fw-bold" style="color: #abd700;">Mata Pelajaran</label>
                        <select name="id_matpel" class="form-select" required>
                            <option value="" hidden>Mata Pelajaran</option>
                            @foreach ($matpels as $mp)
                                <option value="{{ $mp->id_matpel }}">{{ $mp->nama_matpel }}</option>
                            @endforeach
                        </select>
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
@foreach ($pembelajarans as $pb)
    <div class="modal fade" id="datapembelajaranEdit{{ $pb->id_bel }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Edit Data Pembelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data layanan -->
                    <form action="{{ url('/pembelajaranadminupdate', $pb->id_bel) }}" method="POST" id="editform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Guru</label>
                        <select name="id_guru" class="form-select" required>
                            @foreach ($gurus as $gr)
                                <option value="{{ $gr->id_guru }}" {{ old('id_guru', $pb->id_guru) == $gr->id_guru ? 'selected' : null}}>{{ $gr->nama_guru }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Nama Kelas</label>
                        <select name="id_kelas" class="form-select" required>
                            @foreach ($kelas as $kl)
                                <option value="{{ $kl->id_kelas }}" {{ old('id_kelas', $pb->id_kelas) == $kl->id_kelas ? 'selected' : null}}>{{ $kl->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Mata Pelajaran</label>
                        <select name="id_matpel" class="form-select" required>
                            @foreach ($matpels as $mp)
                                <option value="{{ $mp->id_matpel }}" {{ old('id_matpel', $pb->id_matpel) == $mp->id_matpel ? 'selected' : null}}>{{ $mp->nama_matpel }}</option>
                            @endforeach
                        </select>
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
    @foreach ($pembelajarans as $pb)
    <div id="deleteDatapembelajaran{{ $pb->id_bel }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">   
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 "><div class="row"><div class="col ml-auto"></div> </div>
                        <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p><p class="text-muted "> These changes will be visible on your portal and the data will be deleted.</p>     </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0"> 
                            <div class="row justify-content-end no-gutters"><div class="col-auto"><button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button> &nbsp; <a class="btn btn-danger px-4" href="/pembelajaranadmindelete/{{ $pb->id_bel }}" role="button">Delete</a></div><div class="col-auto"></div></div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection