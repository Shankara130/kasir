<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\produk;
use App\Models\Diskon;
use App\Models\Stok;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = produk::all();
        $stok = Stok::all();
        $kategori = Kategori::all();

        return view('produk.index', compact('kategori', 'produk', 'stok'));
    }

    public function addProducttoCart(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $produk->nama_produk,
                "quantity" => $request->quantity ?? 1,
                "price" => $produk->harga
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Berhasil ditambahkan ke keranjang']);
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Berhasil ditambahkan ke keranjang');
        }
    }

    public function deleteProduct(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Item berhasil di hapus');
        }
    }

    public function data()
    {
        $produk = produk::leftJoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
            ->select('produk.*', 'nama_kategori')
            ->get();

        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('select_all', function ($produk) {
                return '
                    <input type="checkbox" name="id_produk[]" value="' . $produk->id_produk . '">
                ';
            })
            ->addColumn('harga', function ($produk) {
                return format_angka($produk->harga);
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`' . route('produk.update', $produk->id_produk) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></button>
                    <button type="button" onclick="deleteData(`' . route('produk.destroy', $produk->id_produk) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'select_all'])
            ->make(true);
    }

    // 1. Rapihkeun hela javascriptna
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil file yang diupload
        $file = $request->file('foto_produk');

        // Pindahkan file ke folder penyimpanan
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $produk = new produk;
        $produk->id_kategori = $request->id_kategori;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->foto_produk = $fileName;
        $produk->save();

        return response()->json(['success' => 'Data berhasil disimpan']);

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = produk::find($id);

        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Ambil file yang diupload
        $file = $request->file('foto_produk');

        if ($file) {
            // Jika ada file upload, pindahkan ke folder penyimpanan
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
        }

        // Ambil data produk yg akan diubah
        $produk = Produk::findOrFail($id);

        // Update data produk
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        if ($file) {
            // Jika ada file upload, update nama file
            $produk->foto_produk = $fileName;
        }

        $produk->save();

        return response()->json(['success' => 'Data berhasil diubah']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = produk::find($id);
        $produk->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
            $produk = produk::find($id);
            $produk->delete();
        }

        return response(null, 204);
    }
}
