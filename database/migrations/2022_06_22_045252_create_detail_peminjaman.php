<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peminjaman_id')->unsigned()->nullable();
            $table->bigInteger('barang_id')->unsigned();
            $table->integer('qty');
            $table->timestamps();
            $table->foreign('barang_id')->references('id')->on('barang');
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_detail');
    }
}
