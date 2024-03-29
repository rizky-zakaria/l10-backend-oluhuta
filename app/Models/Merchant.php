<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'deskripsi', 'gambar_id', 'phone', 'jenis'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function gambar()
    {
        return $this->belongsTo(Gambar::class);
    }
}
