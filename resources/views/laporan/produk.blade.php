@extends('layout.app-layout')

@section('title')
    <title>Laporan Penjualan Produk</title>
@endsection


@section('sisipancss')
    
@endsection

@section('sisipanjs')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
@endsection

@section('breadcrumb')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Laporan Penjualan Produk</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Laporan Penjualan Produk</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('mainpage')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan Penjualan Produk {{ $bulan }} {{ $tahun }}</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Bulan</th>
                        <th>Produk</th>
                        <th>Terjual</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        let table;

        $(function () {
            table = $('.table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('laporan.produk.data', [$bulan, $tahun]) }}',
                },
                columns: [
                    {data: null, searchable: false, sortable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {data: 'created_at',
                    render: function (data, type, row) {
                        return moment(data).format('MMMM YYYY');
                    }
                },
                    {data: 'nama_produk'},
                    {data: 'jumlah'}
                ],
                dom: 'Brt',
                bSort: false,
                bPaginate: false,
            });

        });
    </script>
@endpush
