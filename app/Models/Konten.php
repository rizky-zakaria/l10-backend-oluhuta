<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'sub_judul', 'slug', 'gambar_id', 'isi', 'tgl_post', 'kategori_id'];

    public $timestamps = false;
}
