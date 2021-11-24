<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBarang20200120039Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_barang_20200120039', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('kode_barang', 20);
            $table->string('nama_barang', 100);
            $table->string('jenis_barang', 50);
            $table->integer('harga');
            $table->integer('jumlah');
            $table->text('gambar');
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
        Schema::dropIfExists('data_barang_20200120039');
    }
}
