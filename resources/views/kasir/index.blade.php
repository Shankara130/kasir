@extends('layout/app-layout')

@section('sisipancss')
@endsection
@section('sisipanjs')
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

        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('keyup', function() {

            const searchTerm = searchInput.value.toLowerCase();

            const produkCards = document.querySelectorAll('.produk-card');

            produkCards.forEach(card => {

                const title = card.querySelector('.card-title').textContent.toLowerCase();

                if (title.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }

            });

        });

        function addToCart(productId, index) {
            const quantity = counterValues[index];

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ route('addproduct.to.cart', ['id' => '__productId__']) }}`.replace('__productId__',
                productId);

            const input1 = document.createElement('input');
            input1.type = 'hidden';
            input1.name = '_token';
            input1.value = '{{ csrf_token() }}';

            const input2 = document.createElement('input');
            input2.type = 'hidden';
            input2.name = 'quantity';
            input2.value = quantity;

            form.appendChild(input1);
            form.appendChild(input2);

            document.body.appendChild(form);
            form.submit();
        }

        function setnamaproduk(index) {
            let namaproduk = getNamaproduks[index].textContent;
            setNamaProduks[index].textContent = namaproduk;
        }

        function updateCounterInput(input, index) {
            let value = parseInt(input.value);
            if (isNaN(value)) {
                value = 0;
            }
            counterValues[index] = value;
            updateCounter(index);
        }

        function updateCounter(index) {
            counterElements[index].textContent = counterValues[index];

            document.querySelectorAll(".counter-input")[index].value = counterValues[index];

            show(index);

            document.querySelectorAll(".counter-input")[index].value = '';
        }

        function showHarga(index) {
            let jml = counterValues[index] + 0;
            let nominal = parseInt(hargaElements[index].textContent)
            let hargatotal = nominal * jml;
            harga1Elements[index].textContent = hargatotal;
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
                        <li class="breadcrumb-item"><a href="admin"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="admin">Menu Kasir</a></li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-end">
                <a href="{{ route('transaksi.cart') }}" class="btn btn-outline-light">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Keranjang <span
                        class="badge bg-danger">{{ count((array) session('cart')) }}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection

@section('mainpage')
Nama Produk: <input class="col-md-3 ml-2 mb-4" type="text" id="searchInput" placeholder="Cari produk...">
    <div class="row">
        @foreach ($produk as $index => $produk)
            <div class="col-md-3 col-6 mb-4 produk-card">
                <div class="card">
                    @if ($produk->foto_produk)
                        <img src="{{ asset('storage/images/' . $produk->foto_produk) }}" alt="">
                    @else
                        <img src="{{ asset('assets/images/produk/default.png') }}" alt="">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $produk->nama_produk }}</h4>
                        <p class="card-text"><strong>Harga: </strong> Rp. {{ format_angka($produk->harga) }}</p>
                        <div class="d-flex justify-content-center">
                            <button class="fw-bold btn btn-primary w-25 decrease">-</button>
                            <input type="text" class="form-control counter-input text-center" style="width: 60px;"
                                onkeyup="updateCounterInput(this, {{ $index }})" value="0">
                            <span class="mx-2 counter d-none" id="counter{{ $produk->id_produk }}">0</span>
                            <button class="fw-bold btn btn-primary w-25 increase"">+</button>
                        </div> <br>
                        <div class="d-flex justify-content-center">
                            <p class="btn-holder"><a href="#"
                                    onclick="addToCart('{{ $produk->id_produk }}',  '{{ $index }}')"
                                    class="btn btn-outline-danger">Tambahkan ke keranjang</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
