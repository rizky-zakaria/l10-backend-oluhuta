<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'sub_judul', 'slug', 'gambar_id', 'isi', 'tgl_post'];

    public $timestamps = false;
}
