@extends('layout/app-layout')

@section('sisipancss')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>
@endsection
@section('sisipanjs')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
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
                    <li class="breadcrumb-item"><a href="{{route('kasir')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Data Produk</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('mainpage')
<div class="row">
    <table id="myTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <!-- Tambahkan kolom sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John Doe</td>
                <td>25</td>
                <!-- Tambahkan data sesuai kebutuhan -->
            </tr>
            <!-- Tambahkan baris data lainnya -->
        </tbody>
    </table>
</div>
@endsection