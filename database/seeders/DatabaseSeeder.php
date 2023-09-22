<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


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
        $this->call(GeodiveristySeeder::class);
        $this->call(CulturdiversitySeeder::class);
        $this->call(BiodiversitySeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(GambarSeeder::class);
    }
}
