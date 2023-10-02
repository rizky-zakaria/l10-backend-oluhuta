<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantKulinerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merchant::create([
            'nama' => 'Rumah Makan Mama Ani',
            'deskripsi' => 'Menjual Semua Kebutuhan Anda',
            'gambar_id' => 1
        ]);
    }
}
