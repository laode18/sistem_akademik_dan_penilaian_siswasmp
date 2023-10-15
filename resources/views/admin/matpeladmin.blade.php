@extends('layouts.admin.app')
@section('content')

    <!-- Home Start -->
    <div class="container-fluid pt-4 px-4">
        <h4>Data Mata Pelajaran</h4>
    </div>
    <br />
    @include('layouts.messages')

    <!-- Popular Destination Configuration -->
    <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                    <td><button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#matpelModal"><i
                        class="fa fa-plus"></i> Tambah Data</button></td>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark text-center" style="background-color: #abd700;">
                                    <th scope="col" style="text-align: center; color: #ffffff;">No.</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Mata Pelajaran</th>
                                    <th scope="col" style="text-align: center; color: #ffffff;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach ($matpels as $mp)
                                <tr class="text-center">
                                    <td>{{$no++}}.</td>
                                    <td>{{ $mp->nama_matpel }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#matpelEdit{{ $mp->id_matpel }}"><i class="fa fa-pen"></i></button> &nbsp;
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMatpel{{ $mp->id_matpel }}"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="matpelModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Tambah Data Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi form untuk menambah data layanan -->
                <form action="{{ route('matpeladminstore') }}" method="POST" id="editform" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Mata Pelajaran</label>
                        <input type="text" name="nama_matpel" class="form-control" placeholder="Mata Pelajaran" required>
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
@foreach ($matpels as $mp)
    <div class="modal fade" id="matpelEdit{{ $mp->id_matpel }}" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Edit Data Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form untuk menambah data layanan -->
                    <form action="{{ url('/matpeladminupdate', $mp->id_matpel) }}" method="POST" id="editform" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                        <label class="fw-bold" style="color: #abd700;">Mata Pelajaran</label>
                        <input type="text" name="nama_matpel" class="form-control" value="{{ $mp->nama_matpel }}" required>
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
    @foreach ($matpels as $mp)
    <div id="deleteMatpel{{ $mp->id_matpel }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">   
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 "><div class="row"><div class="col ml-auto"></div> </div>
                        <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p><p class="text-muted "> These changes will be visible on your portal and the data will be deleted.</p>     </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0"> 
                            <div class="row justify-content-end no-gutters"><div class="col-auto"><button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Cancel</button> &nbsp; <a class="btn btn-danger px-4" href="/matpeladmindelete/{{ $mp->id_matpel }}" role="button">Delete</a></div><div class="col-auto"></div></div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection