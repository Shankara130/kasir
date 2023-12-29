@extends('layout/app-layout')

@section('title')
    <title>Data Stok</title>
@endsection

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
                    <li class="breadcrumb-item"><a href="#!">Data Kategori</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('mainpage')

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add">Tambah Stok</button>
<div id="add" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('stok.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="id_kategori">Stok Produk</label>
                        <select class="form-control" id="id_produk" name="id_produk">
                            @foreach ($produk as $p)
                            <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="stok_in">Stok Masuk</label>
                        <input type="text" class="form-control" id="stok_in" name="stok_in">
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
                <th>Nama Produk</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Total Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stok as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->produk->nama_produk }}</td>
                <td>{{ $s->stok_in }}</td>
                <td>{{ $s->stok_out }}</td>
                <td>{{ $s->total_stok }}</td>
                <td><button>detail</button></td>
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
