<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['kode_produk', 'kategori_id','foto', 'nama', 'harga',];
    public function produk()
    {
        return $this->belongsTo('Produk::class');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Scope a query to apply search & category filters.
     */
    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['q'])) {
            $query->where('nama', 'like', '%' . $filters['q'] . '%');
        }
        if (!empty($filters['kategori'])) {
            $query->where('kategori_id', $filters['kategori']);
        }
        return $query;
    }
}
