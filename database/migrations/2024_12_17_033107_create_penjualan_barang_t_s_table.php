<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanBarangTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_barang_t_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barang_id')->unsigned();
            $table->foreign('barang_id')->references('id')->on('barang_m_s')->onDelete('cascade');
            $table->bigInteger('jenisbarang_id')->unsigned();
            $table->foreign('jenisbarang_id')->references('id')->on('jenis_barang_m_s')->onDelete('cascade');
            $table->integer('jumlahyangdibeli');
            $table->integer('stock_awal');
            $table->dateTime('tanggal_transaksi');
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
        Schema::dropIfExists('penjualan_barang_t_s');
    }
}
