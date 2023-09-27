<?php

namespace Database\Seeders;

use App\Models\MerchantEkonomiKreatif;
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
        MerchantEkonomiKreatif::create([
            'nama' => 'Rumah Makan Mama Ani',
            'deskripsi' => 'Menjual Semua Kebutuhan Anda',
            'gambar_id' => 1
        ]);
    }
}
