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
    }
}
