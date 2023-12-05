<?php

namespace App\Http\Controllers;


use App\Models\Kategori;
use App\Models\produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
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
        $kategori = Kategori::all();
        $produk = $this->models->all();
    
    return view('produk.index', compact('kategori', 'produk'));
    }

    public function data()
    {
        //
    }

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
    //try {
        // Exclude 'id_produk' from the request data
        $data = $request->except('id_produk');

        // Attempt to create a new Produk instance
        $produk = Produk::create($data + ['id_produk' => null]);

        // Log or dd() the created Produk instance to inspect the result
        //dd($produk);

        // Redirect to the index page after successful creation
        return redirect('/produk')->with('success', 'Produk created successfully');
    //} catch (\Exception $e) {
        // Log or dd() the exception to see what's happening
       // dd($e->getMessage());
        // Handle the exception as needed
        return redirect('/produk')->with('error', 'Failed to create Produk');
    
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = Produk::find($id);

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
        $kategori = Kategori::find($id);
        $kategori->update($request->all());
        
        return response()->json('Data berhasil diubah', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return redirect('/produk');
    }
}
