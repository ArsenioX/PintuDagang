<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public function produk()
    {
        return $this->belongsTo('Produk::class');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // use HasFactory;
    protected $fillable = ['kode_produk', 'kategori_id','foto', 'nama', 'harga',];
}
