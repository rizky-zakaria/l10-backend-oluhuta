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
        Schema::create('barang_sewas', function (Blueprint $table) {
            $table->id();
            $table->string('produk');
            $table->integer('harga');
            $table->integer('stok');
            $table->bigInteger('gambar_id');
            $table->text('deskripsi');
            $table->text('ketentuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_sewas');
    }
};
