<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\produk;
use App\Models\Setting;
use App\Models\Stok;
use App\Models\Diskon;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    
    public function index()
    {
        return view('penjualan.index');
    }

    public function data()
    {
        $penjualan = Penjualan::orderBy('id_penjualan', 'desc')->get();

        return datatables()
            ->of($penjualan)
            ->addIndexColumn()
            ->addColumn('total_item', function ($penjualan) {
                return format_angka($penjualan->total_item);
            })
            ->addColumn('total_harga', function ($penjualan) {
                return 'Rp. '. format_angka($penjualan->total_harga);
            })
            ->addColumn('bayar', function ($penjualan) {
                return 'Rp. '. format_angka($penjualan->bayar);
            })
            ->addColumn('tanggal', function ($penjualan) {
                return tanggal($penjualan->created_at, false);
            })
            ->editColumn('diskon', function ($penjualan) {
                return $penjualan->diskon . '%';
            })
            ->editColumn('kasir', function ($penjualan) {
                return $penjualan->user->name ?? '';
            })
            ->addColumn('aksi', function ($penjualan) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('penjualan.show', $penjualan->id_penjualan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('penjualan.destroy', $penjualan->id_penjualan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diskon = Diskon::all();
        $penjualan = new Penjualan();
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->id_user = auth()->id();
        $penjualan->save();

        session(['id_penjualan' => $penjualan->id_penjualan]);
        return view('kasir.cart', compact('diskon'));
    }

    
    public function store(Request $request)
    {
        $penjualan = Penjualan::findOrFail($request->id_penjualan);
        $penjualan->total_item = $request->total_item;
        $penjualan->total_harga = $request->total;
        $penjualan->diskon = $request->diskon;
        $penjualan->bayar = $request->bayar;
        $penjualan->update();

        $detail = DetailPenjualan::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $item->diskon = $request->diskon;
            $item->update();

            $produk = produk::find($item->id_produk);
            $produk->stok -= $item->jumlah;
            $produk->update();

            $stok = Stok::find($item->id_produk);
            $stok->stok_out += $item->jumlah;
            $stok->total_stok = $item->stok_in - $stok->stok_out;
            $stok->update();
        }

        return redirect()->route('transaksi.selesai');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detail = DetailPenjualan::with('produk')->where('id_penjualan', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_jual', function ($detail) {
                return 'Rp. '. format_angka($detail->harga);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_angka($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. '. format_angka($detail->subtotal);
            })
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);
        $detail    = DetailPenjualan::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok += $item->jumlah;
                $produk->update();
            }

            $item->delete();
        }

        $penjualan->delete();

        return response(null, 204);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('transaksi.selesai', compact('setting'));
    }

    public function nota()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('id_penjualan'));
        if (! $penjualan) {
            abort(404);
        }
        $detail = DetailPenjualan::with('produk')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();
        
        return view('penjualan.nota', compact('setting', 'penjualan', 'detail'));
    }
}
