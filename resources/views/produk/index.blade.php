@extends('layout/app-layout')

@section('sisipancss')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section('sisipanjs')




@endsection
@section('breadcrumb')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Data produk</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Data Produk</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('mainpage')

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add">Tambah Poduk</button>
<div id="add" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="id_kategori">Kategori Produk</label>
                        <select class="form-control" id="id_kategori" name="id_kategori">
                            @foreach ($kategori as $k)
                            <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="nama_Produk">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk">
                    </div>
                    <div class="form-group mb-5">
                        <label class="floating-label" for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="form-group mb-6">
                        <label class="floating-label" for="stok">Stok</label>
                        <input type="text" class="form-control" id="stok" name="stok">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</a></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="row">

    <table id="tablecustomer" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $p)
            <tr>
                <td>{{ $p->id_produk }}</td>
                <td>{{ $p->kategori->nama_kategori }}</td>
                <td>{{ $p->nama_produk }}</td>
                <td>{{ $p->harga }}</td>
                <td>{{ $p->stok }}</td>
                <form action="{{ route('produk.destroy', $p) }}" method="GET">
                    @csrf
                <td><button>detail</button></td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    let table = new DataTable('#tablecustomer');

    $(document).ready(function () {
        $('#tablecustomer').DataTable({
            paging: true,
            ordering: false,
            info: false,
            searching: true,
            language: {
                search: "",
                search: "INPUT",
                searchPlaceholder: "Keyword Pencarian Disini"
            },
            "lengthChange": false,
            "pageLength": 15,
        });
        $('.dataTables_filter').addClass('pull-left');
        $('.dataTables_paginate').addClass('pull-left');
    });

</script>
@endsection
