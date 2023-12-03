<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk')->insert([
            'id_produk' => 1,
            'id_kategori' => 1,
            'nama_produk' => 'Kopi',
            'harga' => '10000',
            'foto_produk' => '',
            'stok' => 10,
            
        ]);
    }
}
