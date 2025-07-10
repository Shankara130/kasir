<!DOCTYPE html>
<html lang="en">

<head>
@yield('title')
@yield('sisipancss')
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('img/' . $setting->path_logo) }}" type="image/x-icon">
    <!-- vendor css -->
    <link rel="stylesheet"   href="{{ asset('assets/css/style.css') }}">
</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menu-light ">
        @include('layout.sidebar')
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        @include('layout.header')
    </header>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @yield('breadcrumb')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            @yield('mainpage')
            <!-- [ Main Content ] end -->
        </div>
    </div>
    
    <!-- Required Js -->
    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ripple.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
    @yield('sisipanjs')
    <!-- Apex Chart -->
    {{-- <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script> --}}

    <!-- custom-chart js -->
    {{-- <script src="{{ asset('assets/js/pages/dashboard-main.js') }}"></script> --}}
    <script>
        function preview(selector, temporaryFile, width = 200)  {
            $(selector).empty();
            $(selector).append(`<img src="${window.URL.createObjectURL(temporaryFile)}" width="${width}">`);
        }
    </script>
    @stack('scripts')
</body>

</html>