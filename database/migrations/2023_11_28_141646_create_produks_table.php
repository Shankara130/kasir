<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk')->unsigned();
            $table->integer('id_kategori');
            $table->string('nama_produk')->unique();
            $table->bigInteger('harga');
            $table->string('foto_produk')->nullable();
            $table->integer('stok')->default(0);
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
