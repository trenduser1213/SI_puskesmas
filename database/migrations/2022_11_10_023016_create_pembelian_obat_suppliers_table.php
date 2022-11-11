<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianObatSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_obat_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obat_id');
            $table->date('tanggalproduksi');
            $table->date('tanggalkadaluarsa');
            $table->integer('stok');
            $table->integer('sisa_obat');
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
        Schema::dropIfExists('pembelian_obat_suppliers');
    }
}
