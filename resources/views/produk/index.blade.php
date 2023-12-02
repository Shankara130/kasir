@extends('layout/app-layout')

@section('sisipancss')
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
</div>
@endsection