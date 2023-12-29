@extends('layout.app-layout')
@section('title')
    <title>Dashboard</title>
@endsection

@section('sisipancss')
@endsection
@section('sisipanjs')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('breadcrumb')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
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
                <h3 class="box-title">Grafik Pendapatan {{ tanggal($tanggal_awal, false) }} s/d {{ tanggal($tanggal_akhir, false) }}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <canvas id="salesChart" style="height: 180px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var salesChartCanvas = $('#salesChart')[0].getContext('2d');

    var salesChartData = {
    labels: {!! json_encode($data_tanggal) !!},
    datasets: [
        {
            label: 'Pendapatan',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointBackgroundColor: '#3b8bba',
            pointBorderColor: 'rgba(60,141,188,1)',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgba(60,141,188,1)',
            data: {!! json_encode($data_pendapatan) !!}
        }
    ]
};

    var salesChartOptions = {
        elements: {
            point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4,
                hoverBorderWidth: 3
            }
        },
        responsive: true
    };

    var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: salesChartData,
        options: salesChartOptions
    });
</script>
@endpush
