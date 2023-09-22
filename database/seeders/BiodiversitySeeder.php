<?php

namespace Database\Seeders;

use App\Models\Konten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BiodiversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Konten::create([
            'judul' => 'Lorem, ipsum dolor.',
            'sub_judul' => 'Lorem ipsum dolor sit amet.',
            'slug' => Str::slug('Lorem, ipsum dolor.'),
            'gambar_id' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam esse incidunt maxime enim id? Possimus, voluptas perspiciatis. Perferendis nesciunt itaque pariatur, ipsam autem error quidem! Voluptatem alias optio rerum obcaecati voluptatum consectetur quam consequuntur error aliquid sapiente illum in cum doloremque explicabo inventore enim minus, veritatis a. Tempore, odio amet? Amet dignissimos animi rerum explicabo molestiae, saepe assumenda similique qui? Culpa eaque, accusantium ut ipsam at provident exercitationem officiis minima eos fugit ad autem magni laudantium inventore! Repudiandae quam accusamus saepe illum inventore, minus impedit provident aut explicabo adipisci quo exercitationem. Molestiae accusamus nesciunt sint mollitia officia, aspernatur nisi dolor.',
            'tgl_post' => now(),
            'kategori_id' => 3
        ]);
    }
}
