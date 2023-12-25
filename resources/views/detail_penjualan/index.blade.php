@extends('layout/app-layout')

@section('sisipancss')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
                    <li class="breadcrumb-item"><a href="#!">Data Transaksi</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('mainpage')

<div class="row">

    <table id="tablecustomer" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Total Item</th>
                <th>Total Harga</th>
                <th>Diskon</th>
                <th>Total Bayar</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $penjualan)
                <tr>
                    <td>{{ $penjualan->id_penjualan }}</td>
                    <td>{{ $penjualan->created_at }}</td>
                    <td>{{ $penjualan->total_item }}</td>
                    <td>{{ $penjualan->total_harga }}</td>
                    <td>{{ $penjualan->diskon }}</td>
                    <td>{{ $penjualan->bayar }}</td>
                    <td>detail</td>
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