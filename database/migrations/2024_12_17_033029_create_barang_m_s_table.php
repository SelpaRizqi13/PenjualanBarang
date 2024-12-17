<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_m_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenisbarang_id');
            $table->foreign('jenisbarang_id')->references('id')->on('jenis_barang_m_s')->onDelete('cascade');
            $table->string('nama_barang');
            $table->integer('stock');
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
        Schema::dropIfExists('barang_m_s');
    }
}
