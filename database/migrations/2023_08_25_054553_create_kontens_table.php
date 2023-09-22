<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontens', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->string('sub_judul', 100);
            $table->string('slug', 200)->unique();
            $table->bigInteger('gambar_id');
            $table->longText('isi');
            $table->string('tgl_post');
            $table->bigInteger('kategori_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontens');
    }
};
