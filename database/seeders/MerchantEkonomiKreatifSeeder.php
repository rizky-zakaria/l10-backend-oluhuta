<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantEkonomiKreatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merchant::create([
            'nama' => 'Toko Kaldu',
            'deskripsi' => 'Menjual Semua Kebutuhan Anda',
            'gambar_id' => 1,
            'phone' => '081803975109',
            'jenis' => 'umkm'
        ]);
    }
}
