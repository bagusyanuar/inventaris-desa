<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeminjamPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->bigInteger('peminjam_id')->unsigned()->nullable()->after('no_peminjaman');
            $table->foreign('peminjam_id')->references('id')->on('peminjam');
            $table->dropColumn('nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropForeign('peminjaman_peminjam_id_foreign');
            $table->dropColumn('peminjam_id');
        });
    }
}
