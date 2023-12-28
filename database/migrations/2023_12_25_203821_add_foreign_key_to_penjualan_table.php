<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('detail_penjualan', function (Blueprint $table) {
            $table->unsignedInteger('id_penjualan')->change();
            $table->foreign('id_penjualan')
                ->references('id_penjualan')
                ->on('penjualan')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->unsignedInteger('id_produk')->change();
            $table->foreign('id_produk')
                ->references('id_produk')
                ->on('produk')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_penjualan', function (Blueprint $table) {
            $table->integer('id_penjualan');
            $table->dropForeign(['detail_penjualan_id_penjualan_foreign']);
            $table->integer('id_produk');
            $table->dropForeign(['detail_penjualan_id_produk_foreign']);
        });
    }
};
