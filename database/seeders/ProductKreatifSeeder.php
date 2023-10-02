<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductKreatif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductKreatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product' => 'Mie Goreng',
            'harga' => 20000,
            'stok' => 100,
            'gambar_id' => 1,
            'deskripsi' => 'Rasa Nikmat & Nyaman dilambung',
            'ketentuan' => 'Produk UMKM',
            'kategori' => 'umkm',
            'merchant_id' => 1
        ]);
    }
}
