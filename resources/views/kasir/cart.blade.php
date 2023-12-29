@extends('layout/app-layout')

@section('sisipancss')
    
@endsection
@section('sisipanjs')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    <table id="cart" class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @if (session('cart'))
                @foreach (session('cart') as $id => $details)
                    @php
                        $subtotal = $details['price'] * $details['quantity'];
                        $total += $subtotal;
                    @endphp
                    <tr rowId="{{ $id }}">
                        <td data-th="Produk">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Harga">Rp. {{ format_angka($details['price']) }}</td>
                        <td data-th="Jumlah">{{ $details['quantity'] }}</td>
                        <td data-th="Total">Rp. {{ format_angka($subtotal) }}</td>
                        <td class="actions">
                            <a class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <div class="col-sm-9">
                            <h4 class="nomargin">Total Harga</h4>
                        </div>
                    </div>
                </td>
                <td colspan="2">
                    <h4 class="text-center">Rp. {{ format_angka($total) }}</h4>
                </td>
            </tr>
        </tfoot>
    </table>
    <button class="fw-bold btn rounded-pill btn-outline-primary w-100" data-toggle="modal"
        data-target="#order">Order</button>
    <div id="order" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to place this order?</p>
                    <p>Total Harga: Rp. {{ format_angka($total) }}</p>
                </div>
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_penjualan" value="{{ $id_penjualan }}">
                    <input type="hidden" name="total_item" value="{{ count(session('cart')) }}">
                    <input type="hidden" name="total_harga" value="{{ $total }}">
                    <input type="hidden" name="id_user" value="">
                    <div class="col">
                        <div class="row mb-3">
                            <label for="total_diskon">Diskon</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="total_diskon" name="diskon">
                                    <option selected>Pilih Diskon</option>
                                    @foreach ($diskon as $diskon)
                                        <option value="{{ $diskon->total_diskon }}">{{ $diskon->nama_diskon }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="bayar" class="col-sm-2 col-form-label">Bayar</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="bayar" id="bayar1" value="{{ $total }}">
                                <input type="text" class="form-control" id="bayar" name="bayar1" readonly
                                    value="Rp. {{ format_angka($total) }},00">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="diterima" class="col-sm-2 col-form-label">Diterima</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="diterima" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kembali" class="col-sm-2 col-form-label">Kembali</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kembali" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> Place Order</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const diskonSelected = document.getElementById('total_diskon');
            const bayarInput = document.getElementById('bayar');
            const bayar = document.getElementById('bayar1');
            const diterimaInput = document.getElementById('diterima');
            const kembaliInput = document.getElementById('kembali');
            const totalValue = {{ $total }};

            const formatPrice = (price) => {
                return price.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
            };

            const parseCurrency = (input) => {
                return parseFloat(input.replace(/[^\d.-]/g, ''));
            };

            diskonSelected.addEventListener('change', function() {
                const selectedDiskon = this.value;
                let bayarValue;

                if (!selectedDiskon) {
                    bayarValue = formatPrice(totalValue);
                } else {
                    const diskonPercentage = selectedDiskon / 100;
                    const diskon = totalValue * diskonPercentage;
                    bayarValue = totalValue - diskon;
                }

                bayar.value = bayarValue
                bayarInput.value = formatPrice(bayarValue);
            });

            diterimaInput.addEventListener('input', function() {
                const diterimaValue = parseCurrency(diterimaInput.value) || 0;
                const bayarValue = parseCurrency(bayar.value) || 0;
                const kembaliValue = diterimaValue - bayarValue;
                kembaliInput.value = formatPrice(kembaliValue);
            });
        });
        $(".edit-cart-info").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('update.shopping.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("rowId"), 
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
   
    $(".delete-product").click(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        if(confirm("Do you really want to delete?")) {
            $.ajax({
                url: '{{ route('delete.cart.product') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("rowId")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
    </script>
@endsection
