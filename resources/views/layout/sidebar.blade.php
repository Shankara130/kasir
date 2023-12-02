<div class="navbar-wrapper ">
    <div class="navbar-content scroll-div ">
        <div class="">
            <div class="main-menu-header">
                <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
                <div class="user-details">
                    <div id="more-details">Halo, {$kasir} <i class="fa fa-caret-down"></i></div>
                </div>
            </div>
            <div class="collapse" id="nav-user-link">
                <ul class="list-unstyled">
                    <li class="list-group-item"><a href=""><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        <ul class="nav pcoded-inner-navbar ">
            <li class="nav-item pcoded-menu-caption">
                <label>Navigation</label>
            </li>
            <li class="nav-item">
                <a href="{{route('admin')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Kasir</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('produk.data')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-package"></i></span><span class="pcoded-mtext">Produk</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('kategori.data')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Kategori Produk</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file"></i></span><span class="pcoded-mtext">Transaksi</span></a>
            </li>



        </ul>



    </div>
</div>