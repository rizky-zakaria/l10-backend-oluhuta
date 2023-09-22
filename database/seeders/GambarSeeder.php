<?php

namespace Database\Seeders;

use App\Models\Gambar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GambarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gambar = ['Geodiveristy', 'Culturdiversity', 'Biodiversity'];
        // $path = ['uploads/img/mobile-app.png', 'Culturdiversity', 'Biodiversity'];

        for ($i = 0; $i < count($gambar); $i++) {
            Gambar::create([
                'gambar' => $gambar[$i],
                'path' => 'uploads/img/mobile-app.png',
                'jenis' => '-'
            ]);
        }
    }
}
