<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    protected $models;
    public function __construct(produk $models)
    {
        $this->models= $models;
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stok = Stok::all();
        $produk = $this->models->all();

        return view('stok.index', compact('stok', 'produk'));
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

        return redirect('/stok');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stok $stok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stok $stok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stok $stok)
    {
        //
    }
}
