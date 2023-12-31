<div class="navbar-wrapper ">
    <div class="navbar-content scroll-div ">
        <div class="">
            <div class="main-menu-header">
                <img class="img-radius" src="{{ url(auth()->user()->foto ?? '') }}" alt="User-Profile-Image">
                <div class="user-details">
                    <div id="more-details">Halo, {{ auth()->user()->name }} <i class="fa fa-caret-down"></i></div>
                </div>
            </div>
            <div class="collapse" id="nav-user-link">
                <ul class="list-unstyled">
                    <li class="list-group-item"><a href="{{ route('user.profil') }}"><i class="feather icon-user m-r-5"></i>Profil</a></li>
                    <li class="list-group-item"><a href="#" onclick="$('#logout-form').submit()"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        <ul class="nav pcoded-inner-navbar ">
            <li class="nav-item pcoded-menu-caption">
                <label>Navigation</label>
            </li>
            @if (auth()->user()->level == 1)
            <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('laporan.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file"></i></span><span class="pcoded-mtext">Laporan Pendapatan</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('laporan.produk.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file"></i></span><span class="pcoded-mtext">Laporan Penjualan Produk</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('penjualan.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file"></i></span><span class="pcoded-mtext">Penjualan</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('setting.index') }}" class="nav-link"><span class="pcoded-micon"><i class="fa fa-cogs"></i></span><span class="pcoded-mtext">Pengaturan</span></a>
            </li>   
            @else
            <li class="nav-item">
                <a href="{{route('admin')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Transaksi</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('produk.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-package"></i></span><span class="pcoded-mtext">Produk</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('kategori.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Kategori Produk</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('stok.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Stok Produk</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('diskon.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Diskon</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('penjualan.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file"></i></span><span class="pcoded-mtext">Penjualan</span></a>
            </li>
                
            @endif



        </ul>



    </div>
</div>
<form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
    @csrf
</form> 