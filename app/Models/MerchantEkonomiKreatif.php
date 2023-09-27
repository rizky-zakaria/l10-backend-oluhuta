<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantEkonomiKreatif extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'deskripsi', 'gambar_id'];
}
