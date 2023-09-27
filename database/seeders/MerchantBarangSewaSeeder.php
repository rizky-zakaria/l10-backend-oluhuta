<?php

namespace Database\Seeders;

use App\Models\MerchantBarangSewa;
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
        MerchantBarangSewa::create([
            'nama' => 'Rumah Makan Mama Ani',
            'deskripsi' => 'Menjual Semua Kebutuhan Anda',
            'gambar_id' => 1
        ]);
    }
}
