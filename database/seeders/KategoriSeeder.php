<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = ['Geodiveristy', 'Culturdiversity', 'Biodiversity', 'Berita'];

        for ($i = 0; $i < count($kategori); $i++) {
            Kategori::create([
                'kategori' => $kategori[$i]
            ]);
        }
    }
}
