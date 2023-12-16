@extends('layout/app-layout')

@section('sisipancss')
@endsection
@section('sisipanjs')
    <script>
        function format_angka(angka) {
            angka = Math.abs(parseInt(angka));

            return new Intl.NumberFormat('id-ID').format(angka);
        }
    </script>


    </script>

    <script>
        const counterElements = document.querySelectorAll(".counter");
        const increaseButtons = document.querySelectorAll(".increase");
        const decreaseButtons = document.querySelectorAll(".decrease");
        const getNamaproduks = document.querySelectorAll(".namaproduk");
        const setNamaProduks = document.querySelectorAll(".setnamaproduk");
        const resetButtons = document.querySelectorAll(".reset");
        const elements = document.querySelectorAll(".showMenu");
        const hargaElements = document.querySelectorAll(".harga");
        const harga1Elements = document.querySelectorAll(".harga1");
        let counterValues = Array.from({
            length: counterElements.length
        }, () => 0);

        function setnamaproduk(index) {
            let namaproduk = getNamaproduks[index].textContent;
            setNamaProduks[index].textContent = namaproduk;
        }

        function updateCounter(index) {
            counterElements[index].textContent = counterValues[index];
            show(index);
        }

        function showHarga(index) {
            let jml = counterValues[index] + 0;
            let nominalText = String(hargaElements[index].textContent);
            let nominal = parseFloat(nominalText.replace(/[^\d.]/g, ''));
            let hargatotal = nominal * jml;
            let formattedHarga = format_angka(hargatotal);
            harga1Elements[index].textContent = formattedHarga;
        }

        function show(index) {
            if (counterValues[index] === 0) {
                elements[index].classList.add("d-none");
            } else {
                elements[index].classList.remove("d-none");
                setnamaproduk(index);
                showHarga(index);
                showCounter(index);
            }
        }

        function showCounter(index) {
            const counter1Elements = document.querySelectorAll(".counter1");
            counter1Elements[index].textContent = counterValues[index];
        }

        function resetCounter(index) {
            counterValues[index] = 0;
            elements[index].classList.add("d-none");
            updateCounter(index);
        }

        increaseButtons.forEach((button, index) => {
            button.addEventListener("click", function() {
                counterValues[index]++;
                updateCounter(index);
            });
        });

        decreaseButtons.forEach((button, index) => {
            button.addEventListener("click", function() {
                if (counterValues[index] > 0) {
                    counterValues[index]--;
                    updateCounter(index);
                }
            });
        });

        resetButtons.forEach((button, index) => {
            button.addEventListener("click", function() {
                resetCounter(index);
            });
        });

        updateCounter(0);
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
                        @foreach ($produk as $index => $p)
                            <div class="col col-lg-4 col-md-6 col-sm-8">
                                <div class="card shadow mx-2">
                                    <div class="card-header namaproduk">
                                        <strong>{{ $p->nama_produk }}</strong> <br>
                                    </div>
                                    <div class="card-body">
                                        @if ($p->foto_produk)
                                            <img src="assets/images/produk/{{ $p->foto_produk }}" alt=""
                                                class="card-img-top">
                                        @else
                                            <img src="assets/images/produk/default.png" alt="" class="card-img-top">
                                        @endif
                                    </div>
                                    <div class="card-footer ">
                                        <div class="d-flex justify-content-center mb-2">
                                            Rp. <div class="harga">{{ format_angka($p->harga) }}</div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button class="fw-bold btn btn-primary w-25 decrease">-</button>
                                            <span class="mx-2 counter">0</span>
                                            <button class="fw-bold btn btn-primary w-25 increase"
                                                onclick="show({{ $index }})">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                        @foreach ($produk as $index => $p)
                            <div class="row my-2">
                                <div class="col">
                                    <div class="card-body shadow d-none showMenu" role="">
                                        <button type="button" class="close reset" aria-label="Close"
                                            onclick="resetCounter({{ $index }})"><span
                                                aria-hidden="true">×</span></button>
                                        <div class="setnamaproduk">
                                            <strong>{{ $p->nama_produk }}</strong>
                                        </div>
                                        <small><span class="mx-2 counter1"></span></small>
                                        <small><span class="mx-2 harga1">{{ format_angka($p->harga) }}</span></small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row my-2 mx-2">
                            <div class="d-flex flex justify-content-between">
                                <h6>
                                    Total : <span class="text-end total"> Total</span>
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
