@extends('adminlte::page')
@section('title', 'Tambah Pembelian')
@section('content_header')<h1 class="m-0 text-dark">Tambah Pembelian</h1>
@stop
@section('content')
<form action="{{route('pembelian.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="nonota_beli">No Nota Beli</label>
                        <input type="text" class="form-control
@error('nonota_beli') is-invalid @enderror" id="nonota_beli" placeholder="No Nota Beli"
                            name="nonota_beli" value="{{old('nonota_beli')}}">
                        @error('nonota_beli') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="tgl_beli">Tanggal Beli</label>
                        <input type="datetime-local" class="form-control 
@error('tgl_beli') is-invalid @enderror" id="tgl_beli" placeholder="Tanggal Beli" name="tgl_beli" value="{{old('tgl_beli')}}">
                        @error('tgl_beli') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="total_beli">Total Beli</label>
                        <input type="number" class="form-control 
@error('total_beli') is-invalid @enderror" id="total_beli" placeholder="Total Beli" name="total_beli" value="{{old('total_beli')}}">
                        @error('total_beli') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_distributor">Nama Distributor</label>
                        <div class="input-group">
                            <input type="hidden" name="id_distributor" id="id_distributor" value="{{old('id_distributor')}}">
                            <input type="text" class="form-control
@error('nama_distributor') is-invalid @enderror" placeholder="Nama Distributor" id="nama_distributor" name="nama_distributor" value="{{old('nama_distributor')}}" arialabel="Alamat" aria-describedby="cari" readonly>
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari" data-bs-target="#staticBackdrop"></i>
                                Cari Data Nama Distributor</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id_user">Nama User</label>
                        <div class="input-group">
                            <input type="hidden" name="id_user" id="id_user" value="{{old('id_user')}}">
                            <input type="text" class="form-control
@error('name') is-invalid @enderror" placeholder="Nama User" id="name" name="name" value="{{old('name')}}" arialabel="Email" aria-describedby="cari" readonly>
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari" data-bs-target="#staticBackdrop1"></i>
                                Cari Data Nama User</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('pembelian.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bsbackdrop="static" data-bs-keyboard="false" tabindex="-1" arialabelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Data Nama Distributor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered table-stripped" id="example1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Distributor</th>
                                <th>Alamat</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($distributor as $key => $distributor)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$distributor->nama_distributor}}</td>
                                <td>{{$distributor->alamat}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs" 
                                        onclick="pilih('{{$distributor->id}}', '{{$distributor->nama_distributor}}')" data-bs-dismiss="modal">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop1" data-bsbackdrop="static" data-bs-keyboard="false" tabindex="-1" arialabelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel1">Pencarian Data Nama User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs" 
                                        onclick="pilih1('{{$user->id}}', '{{$user->name}}')" data-bs-dismiss="modal">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    @stop
    @push('js')
    <script>
    // Initialize DataTables
    $('#example1').DataTable({
        "responsive": true,
    });

    let namaDistributor = document.getElementById('nama_distributor');
    let idDistributor = document.getElementById('id_distributor');

    //Fungsi pilih untuk memilih data bidang studi dan mengirimkan data Bidang Studi dari Modal ke form tambah

    function pilih(id, distributor) {
        idDistributor.value = id
        namaDistributor.value = distributor
    }


    $('#example2').DataTable({
        "responsive": true,
    });
    //Fungsi pilih untuk memilih data bidang studi dan mengirimkan data Bidang Studi dari Modal ke form tambah

    function pilih1(id, name) {
        document.getElementById('id_user').value = id
        document.getElementById('name').value = name
    }
    </script>
    @endpush