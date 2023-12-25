<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $diskon = Diskon::all();
        $produk = produk::latest()->get();
        $data = array(
            'title' => 'Home Page'
        );

        return view('kasir.index', $data, compact('produk'));
    }
}
