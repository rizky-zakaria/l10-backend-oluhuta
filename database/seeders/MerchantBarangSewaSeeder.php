<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantBarangSewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merchant::create([
            'nama' => 'Toko Ali',
            'deskripsi' => 'Menjual Semua Kebutuhan Anda',
            'gambar_id' => 1,
            'phone' => '6281803975109'
        ]);
    }
}
