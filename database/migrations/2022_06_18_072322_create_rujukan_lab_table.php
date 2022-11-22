<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRujukanLabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rujukan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("kode");
            $table->string("jenis_pemeriksaan");
            $table->integer('rekamedis_id')->unsigned();
            $table->foreign('rekamedis_id')->references('id')->on('rekamedis')->onDelete('cascade');
            $table->integer('tempat_rujukan_id')->unsigned();
            $table->foreign('tempat_rujukan_id')->references('id')->on('tempat_rujukan')->onDelete('cascade');
            $table->dateTime('tglrujukandibuat',$precision=0);
            $table->dateTime('tglberkunjung',$precision=0);
            
            // $table->integer('pasien_id')->unsigned();
            // $table->integer('dokter_id')->unsigned();
            // $table->foreign('pasien_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('dokter_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('rujukan_lab');
    }
}
