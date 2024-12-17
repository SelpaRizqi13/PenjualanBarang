<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisBarangM;
use App\Models\BarangM;
use App\Models\PenjualanBarangT;
use Carbon\Carbon;

class GetDataController extends Controller
{
    public function getJenisBarang()
    {
        $jenisbarang = JenisBarangM::all();
        if ($jenisbarang)
            return ResponseFormatter::success($jenisbarang, 'Data Jenis Barang berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data Jenis Barang tidak ada', 404);

    }

    public function getJenisBarangById($id)
    {
        $jenisbarang = JenisBarangM::find($id);

        if ($jenisbarang)
            return ResponseFormatter::success($jenisbarang, 'Data Jenis Barang berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data Jenis Barang tidak ada', 404);
    }

    public function storeJenisBarang(Request $request)
    {
        $jenisbarang = JenisBarangM::create($request->all());
        if ($jenisbarang)
            return ResponseFormatter::success($jenisbarang, 'Data Jenis Barang berhasil ditambahkan');
        else
            return ResponseFormatter::error(null, 'Data Jenis Barang gagal ditambahkan', 404);
    }

    public function getBarang()
    {
        $barang = BarangM::all();
        if ($barang)
            return ResponseFormatter::success($barang, 'Data  Barang berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data  Barang tidak ada', 404);

    }

    public function getBarangById($id)
    {
        $barang = BarangM::find($id);

        if ($barang)
            return ResponseFormatter::success($barang, 'Data Barang berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data Barang tidak ada', 404);
    }

    public function storeBarang(Request $request)
    {
        $barang = BarangM::create($request->all());
        if ($barang)
            return ResponseFormatter::success($barang, 'Data Jenis Barang berhasil ditambahkan');
        else
            return ResponseFormatter::error(null, 'Data Jenis Barang gagal ditambahkan', 404);
    }

    public function getPenjualanBarang()
    {
        $penjualanbarang = PenjualanBarangT::all();
        if ($penjualanbarang)
            return ResponseFormatter::success($penjualanbarang, 'Data Penjualan Barang berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data Penjualan Barang tidak ada', 404);

    }

    public function getPenjualanBarangById($id)
    {
        $penjualanbarang = PenjualanBarangT::find($id);

        if ($penjualanbarang)
            return ResponseFormatter::success($penjualanbarang, 'Data Penjualan Barang berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data Penjualan Barang tidak ada', 404);
    }

    public function storePenjualanBarang(Request $request)
    {
        
        $barang = BarangM::find($request['barang_id']);
        
        if ($barang->stock < $request['jumlahyangdibeli'])
            return ResponseFormatter::error(null, 'Jumlah barang yang dibeli melebihi stock barang', 400);
        else 
        
        $penjualanbarang = new PenjualanBarangT();
        $penjualanbarang->barang_id = $request['barang_id'];
        $penjualanbarang->jenisbarang_id = $request['jenisbarang_id'];
        $penjualanbarang->jumlahyangdibeli = $request['jumlahyangdibeli'];
        $penjualanbarang->stock_awal = $barang->stock;
        $penjualanbarang->tanggal_transaksi = Carbon::now();
        $penjualanbarang->save();

        $barang->stock -= $penjualanbarang->jumlahyangdibeli;
        $barang->save();

        if ($penjualanbarang)
            return ResponseFormatter::success($penjualanbarang, 'Data Jenis Barang berhasil ditambahkan');
        else
            return ResponseFormatter::error(null, 'Data Jenis Barang gagal ditambahkan', 404);
    }
}
