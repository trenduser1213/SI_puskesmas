<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string("no_regis");
            $table->integer('resep_id')->unsigned();
            $table->integer('pasien_id')->unsigned();
            $table->date('tanggal_periksa');
            $table->date("tanggal_bayar");
            $table->integer("total");
            $table->string("nomor_antrian");
            $table->foreign('resep_id')->references('id')->on('pelayanan_obat')->onDelete('cascade');
            $table->foreign('pasien_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('transaksi');
    }
}
