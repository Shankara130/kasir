<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function stok_total()
    {
        return $this->belongsTo(Stok::class, 'id_produk');
    }
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
