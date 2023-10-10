<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BarangSewa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(GambarSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(GeodiveristySeeder::class);
        $this->call(CulturdiversitySeeder::class);
        $this->call(BiodiversitySeeder::class);
        $this->call(BeritaSeeder::class);
        $this->call(ProductKreatifSeeder::class);
        $this->call(MerchantKulinerSeeder::class);
        $this->call(MerchantBarangSewaSeeder::class);
        $this->call(MerchantEkonomiKreatifSeeder::class);
        $this->call(BarangSewaSeeder::class);
        $this->call(ProdukSeeder::class);
    }
}
