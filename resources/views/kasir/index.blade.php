@extends('layout/app-layout')

@section('sisipancss')


@endsection
@section('sisipanjs')
<script>
    const counterElement = document.getElementById("counter");
    const counterElement1 = document.getElementById("counter1");
    const increaseButton = document.getElementById("increase");
    const decreaseButton = document.getElementById("decrease");
    const getNamaproduk = document.getElementById("namaproduk");
    const setNamaProduk = document.getElementById("setnamaproduk")
    const resetButton = document.getElementById("reset")
    const element = document.getElementById("showMenu");
    const harga = document.getElementById("harga");
    const harga1 = document.getElementById("harga1");
    let counterValue = 0;

    function setnamaproduk() {
        let namaproduk = getNamaproduk.textContent;
        setNamaProduk.textContent = namaproduk;
    }

    function updateCounter() {
        counterElement.textContent = counterValue;
        counterElement1.textContent = counterValue;
    }

    function showHarga() {
        let jml = counterValue + 1
        let nominal = parseInt(harga.textContent);
        let hargatotal = nominal * jml;
        harga1.textContent = hargatotal
    }

    function show() {

        if (element.classList.contains('d-none')) {
            element.classList.remove("d-none");
        }
        setnamaproduk();
        showHarga();
    }
    resetButton.addEventListener("click", function() {
        counterValue = 0;
        element.classList.add("d-none")
        updateCounter();
    });

    increaseButton.addEventListener("click", function() {
        counterValue++;

        updateCounter();
    });

    decreaseButton.addEventListener("click", function() {
        if (counterValue > 0) {
            counterValue--;
            updateCounter();
        }
    });



    updateCounter();
</script>
@endsection
@section('breadcrumb')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Menu Kasir</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Menu Kasir</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('mainpage')
<div class="row">
    <div class="col-lg-9">
        <div class="col-9">
            <div class="">
                <div class="row">
                    <div class="col col-lg-4 col-md-6 col-sm-8">
                        <div class="card shadow mx-2">
                            <div class="card-header" id="namaproduk">
                                <strong> p</strong> <br>
                            </div>
                            <div class="card-body">
                                <img src="assets/images/user/avatar-2.jpg" alt="" class="card-img-top">
                            </div>
                            <div class="card-footer ">
                                <div class="d-flex justify-content-center mb-2">
                                    Rp. <div id="harga">10000</div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button id="decrease" class="fw-bold btn btn-primary w-25">-</button>
                                    <span id="counter" class="mx-2">0</span>
                                    <button id="increase" class="fw-bold btn btn-primary w-25" onclick="show()">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4 class="text">Pesanan</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="row my-2">
                        <div class="col">
                            <div class="card-body shadow d-none" id="showMenu" role="">
                                <button type="button" class="close" id="reset" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <div id="setnamaproduk">
                                    <strong> $namaproduk </strong>
                                </div>
                                <small> <span id="counter1" class="mx-2"></span></small>
                                <small> <span id="harga1" class="mx-2"></span></small>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2 mx-2">
                        <div class="d-flex flex justify-content-between">
                            <h6>
                                Total : <span class="text-end" id="total"> Total</span>
                            </h6>
                        </div>
                    </div>
                    <button class="fw-bold btn rounded-pill btn-outline-primary w-100">Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection