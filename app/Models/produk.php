<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = ['stok'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
