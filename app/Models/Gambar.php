<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;
    protected $fillable = ['gambar', 'path', 'jenis'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function merchant()
    {
        return $this->hasMany(Merchant::class);
    }

    public function konten()
    {
        return $this->hasMany(Konten::class);
    }
}
