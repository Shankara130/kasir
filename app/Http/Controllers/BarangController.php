<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

class BarangController extends Controller
{
    public function index()
    {
        $data = ['judul' => 'Halaman Kasir'];

        return view('kasir.index', $data);
    }
}
