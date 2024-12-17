<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangM;
use App\Models\JenisBarangM;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= BarangM::all();
        return view('pages.admin.master.barang.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model= new BarangM();
        $jenisbarang= JenisBarangM::all();
        return view('pages.admin.master.barang.create', compact('model', 'jenisbarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $jenisbarangIds = $request->jenisbarang_id;
        $nama_barangs = $request->nama_barang;
        $stocks = $request->stock;

        foreach ($jenisbarangIds as $key => $jenisbarangId) {
            $model=new BarangM();
            $model->jenisbarang_id= $jenisbarangId;
            $model->nama_barang=$nama_barangs[$key];
            $model->stock=$stocks[$key];
            $model->save();
        }

        return redirect('barang')->with('success', 'Tambah Data Barang Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = BarangM::find($id);
        return view('pages.admin.master.barang.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = BarangM::find($id);
        $jenisbarang= JenisBarangM::all();
        return view('pages.admin.master.barang.edit', compact('model', 'jenisbarang'));
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
        $model = BarangM::find($id);
        $model->jenisbarang_id= $request->jenisbarang_id;
        $model->nama_barang= $request->nama_barang;
        $model->stock= $request->stock;
        $model->save();

        return redirect('barang')->with('success', 'Update Data Barang Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = BarangM::find($id);
        $model->delete();

        return redirect('barang');
    }
}
