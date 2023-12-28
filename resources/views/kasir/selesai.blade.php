@extends('layout.app-layout')

@section('breadcrumb')
    @parent
    <li class="active">Transaksi Penjualan</li>
@endsection

@section('mainpage')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">
                <div class="alert alert-success alert-dismissible">
                    <i class="fa fa-check icon"></i>
                    Data Transaksi telah selesai.
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-warning btn-flat" onclick="nota('{{ route('transaksi.nota') }}')">Cetak Ulang Nota</button>
                <a href="{{ route('admin') }}">Transaksi Baru</a>
            </div>
        </div>
    </div>
</div>
@endsection