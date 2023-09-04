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
        Schema::create('transaksi_tikets', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('status');
            $table->double('harga');
            $table->bigInteger('ticket_id');
            $table->bigInteger('user_id');
            $table->string('checkout_link');
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
        Schema::dropIfExists('transaksi_tikets');
    }
};
