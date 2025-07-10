<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\Setting;
use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    protected $models;
    public function __construct(produk $models)
    {
        $this->models = $models;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        $stok = Stok::all();
        $produk = $this->models->all();

        return view('stok.index', compact('stok', 'produk', 'setting'));
    }

    public function data()
    {
        $stok = Stok::leftJoin('produk', 'produk.id_produk', 'stok.id_produk')
            ->select('stok.*', 'nama_produk')
            // ->orderBy('kode_produk', 'asc')
            ->get();

        return datatables()
            ->of($stok)
            ->addIndexColumn()
            ->addColumn('select_all', function ($stok) {
                return '
                    <input type="checkbox" name="id_produk[]" value="' . $stok->id_produk . '">
                    ';
            })
            ->addColumn('stok', function ($stok) {
                return format_angka($stok->stok_in);
            })
            ->addColumn('stok', function ($stok) {
                return format_angka($stok->stok_out);
            })
            ->addColumn('stok', function ($stok) {
                return format_angka($stok->total_stok);
            })
            ->addColumn('aksi', function ($stok) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`' . route('stok.update', $stok->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></button>
                    <button type="button" onclick="deleteData(`' . route('stok.destroy', $stok->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'select_all'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existingStok = Stok::where('id_produk', $request->id_produk)->first();

        if ($existingStok) {
            $existingStok->stok_in += $request->stok_in;
            $existingStok->total_stok = $existingStok->stok_in - $existingStok->stok_out;
            $existingStok->save();
        } else {
            $stok = new Stok();
            $stok->id_produk = $request->id_produk;
            $stok->stok_in = $request->stok_in;
            $stok->stok_out = 0;
            $stok->total_stok = $request->stok_in - $stok->stok_out;
            $stok->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'data' => $stok ?? $existingStok
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $stok = Stok::find($id);

        return response()->json($stok);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $stok = Stok::find($id);
        $stok->update($request->stok_in);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diubah!',
            'data' => $stok
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stok = Stok::find($id);
        $stok->delete();

        return response(null, 204);
    }
}
