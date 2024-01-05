<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Illuminate\Http\Request;

class LaporanProdukController extends Controller
{
    public function index(Request $request)
    {
        $bulan = date('m');
        $tahun = date('Y');

        if ($request->has('bulan') && $request->bulan != "" && $request->has('tahun') && $request->tahun != "") {
            $bulan = $request->bulan;
            $tahun = $request->tahun;
        }

        // dd(compact("bulan","tahun"));

        return view('laporan.produk', compact('bulan','tahun'));
    }

    public function getData($bulan, $tahun)
    {
        $dataProduk = DetailPenjualan::whereMonth('detail_penjualan.created_at', $bulan)
                        ->whereYear('detail_penjualan.created_at', $tahun)
                        ->join('produk', 'detail_penjualan.id_produk','=','produk.id_produk')
                        ->select('produk.nama_produk', 'detail_penjualan.jumlah', 'detail_penjualan.created_at')
                        ->get();

        return $dataProduk;
    }

    public function data($bulan, $tahun)
    {
        $data = $this->getData($bulan, $tahun);

        return datatables()
            ->of($data)
            ->make(true);
    }
}
