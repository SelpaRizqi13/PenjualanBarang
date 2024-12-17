<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangM;
use App\Models\JenisBarangM;
use App\Models\PenjualanBarangT;
use Carbon\Carbon;

class PenjualanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = PenjualanBarangT::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            
            $startDate = \Carbon\Carbon::parse($startDate)->startOfDay(); 
            $endDate = \Carbon\Carbon::parse($endDate)->endOfDay(); 

            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        }

        $model = $query->get();

        return view('pages.admin.transaksi.penjualanbarang.index', compact('model'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model= new PenjualanBarangT();
        $barang= BarangM::all();
        $jenisbarang= JenisBarangM::all();
        return view('pages.admin.transaksi.penjualanbarang.create', compact('model','barang', 'jenisbarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $model=new PenjualanBarangT();
        $model->jenisbarang_id= $request->jenisbarang_id;
        $model->barang_id= $request->barang_id;
        $model->jumlahyangdibeli= $request->jumlahyangdibeli;
        $model->stock_awal= 0;
        $model->tanggal_transaksi = Carbon::now();
        if ($model->save()) {
            $barang = BarangM::find($model->barang_id);
            $model->update(['stock_awal' => $barang->stock]);
            $barang->stock = $barang->stock - $model->jumlahyangdibeli;
            $barang->save();
        }
        

        return redirect('penjualanbarang')->with('success', 'Tambah Data Barang Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model= PenjualanBarangT::find($id);
        return view('pages.admin.transaksi.penjualanbarang.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model= PenjualanBarangT::find($id);
        $barang= BarangM::all();
        $jenisbarang= JenisBarangM::all();
        return view('pages.admin.transaksi.penjualanbarang.edit', compact('model','barang', 'jenisbarang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model= PenjualanBarangT::find($id);
        if ($request->jumlahyangdibeli < $model->jumlahyangdibeli) {
            $barang = BarangM::find($model->barang_id);
            $nilai = $model->jumlahyangdibeli - $request->jumlahyangdibeli;
            $barang->stock = $barang->stock + $nilai;

            $barang->save();
        }
        $model->jenisbarang_id= $request->jenisbarang_id;
        $model->barang_id= $request->barang_id;
        $model->jumlahyangdibeli= $request->jumlahyangdibeli;
        $model->save();
        

        return redirect('penjualanbarang')->with('success', 'Update Data Barang Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = PenjualanBarangT::find($id);
        $model->delete();

        return redirect('penjualanbarang');
    }

    public function getBarangByJenisbarang($jenisbarang_id)
    {
        // Ambil barang berdasarkan jenisbarang_id
        $barang = BarangM::where('jenisbarang_id', $jenisbarang_id)->get();
        
        return response()->json($barang);
    }
}
