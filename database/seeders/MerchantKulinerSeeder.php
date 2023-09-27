<?php

namespace Database\Seeders;

use App\Models\MerchantKuliner;
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
        MerchantKuliner::create([
            'nama' => 'Rumah Makan Mama Ani',
            'deskripsi' => 'Menjual Semua Kebutuhan Anda',
            'gambar_id' => 1
        ]);
    }
}
