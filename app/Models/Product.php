<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product', 'harga', 'stok', 'gambar_id', 'deskripsi', 'ketentuan', 'merchant_id', 'kategori'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function gambar()
    {
        return $this->belongsTo(Gambar::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
