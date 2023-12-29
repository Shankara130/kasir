<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penjualan')->insert([
            'id_penjualan' => '1',
            'total_item' => '3',
            'total_harga' => '30000',
            'diskon' => '0',
            'bayar' => '30000',
            'id_user' => '1',
            'created_at' => '2023-12-29',
            'updated_at' => '2023-12-29'
        ]);
        DB::table('penjualan')->insert([
            'id_penjualan' => '2',
            'total_item' => '7',
            'total_harga' => '87000',
            'diskon' => '13000',
            'bayar' => '74000',
            'id_user' => '1',
            'created_at' => '2023-12-29',
            'updated_at' => '2023-12-29'
        ]);
        DB::table('penjualan')->insert([
            'id_penjualan' => '3',
            'total_item' => '2',
            'total_harga' => '12000',
            'diskon' => '0',
            'bayar' => '12000',
            'id_user' => '1',
            'created_at' => '2023-12-29',
            'updated_at' => '2023-12-29'
        ]);
        DB::table('penjualan')->insert([
            'id_penjualan' => '4',
            'total_item' => '3',
            'total_harga' => '32000',
            'diskon' => '2000',
            'bayar' => '32000',
            'id_user' => '1',
            'created_at' => '2023-12-29',
            'updated_at' => '2023-12-29'
        ]);
        DB::table('penjualan')->insert([
            'id_penjualan' => '5',
            'total_item' => '5',
            'total_harga' => '52000',
            'diskon' => '5200',
            'bayar' => '52000',
            'id_user' => '1',
            'created_at' => '2023-12-29',
            'updated_at' => '2023-12-29'
        ]);
    }
}
