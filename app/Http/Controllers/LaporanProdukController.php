<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $namaBulan = $this->getNamaBulanIndonesia($bulan);
        // dd(compact("bulan","tahun"));

        return view('laporan.produk', compact('namaBulan', 'bulan' ,'tahun'));
    }

    private function getNamaBulanIndonesia($bulan)
    {
        $namaBulanIndonesia = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return $namaBulanIndonesia[$bulan];
    }

    public function getData($bulan, $tahun)
    {
        $dataProduk = DetailPenjualan::whereMonth('detail_penjualan.created_at', $bulan)
                        ->whereYear('detail_penjualan.created_at', $tahun)
                        ->join('produk', 'detail_penjualan.id_produk','=','produk.id_produk')
                        ->select('produk.nama_produk', DB::raw('SUM(detail_penjualan.jumlah) as terjual'))
                        ->groupBy('produk.nama_produk')
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
