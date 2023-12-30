<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';
    protected $primaryKey = 'id_detail_penjualan';
    protected $guarded = [];

    public function produk(){
        return $this->belongsTo(produk::class,'id_produk', 'id_produk');
    }

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
