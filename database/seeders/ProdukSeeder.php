<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
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
            'ketentuan' => 'makanan',
            'kategori' => 'makanan',
            'merchant_id' => 3
        ]);
    }
}
