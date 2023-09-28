<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangSewa extends Model
{
    use HasFactory;
    protected $fillable = [
        'produk', 'harga', 'stok', 'gambar_id', 'deskripsi', 'ketentuan'
    ];
}
