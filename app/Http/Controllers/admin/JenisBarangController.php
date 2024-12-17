<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisBarangM;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= JenisBarangM::all();
        return view('pages.admin.master.jenisbarang.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model= new JenisBarangM();
        return view('pages.admin.master.jenisbarang.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model=new JenisBarangM();
        $model->nama_jenisbarang= $request->nama_jenisbarang;
        $model->deskripsi=$request->deskripsi;
        $model->save();


        return redirect('jenisbarang')->with('success', 'Tambah Data Jenis Barang Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = JenisBarangM::find($id);
        return view('pages.admin.master.jenisbarang.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = JenisBarangM::find($id);
        return view('pages.admin.master.jenisbarang.edit', compact('model'));
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
        $model=JenisBarangM::find($id);
        $model->nama_jenisbarang= $request->nama_jenisbarang;
        $model->deskripsi=$request->deskripsi;
        $model->save();


        return redirect('jenisbarang')->with('success', 'Update Data Jenis Barang Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = JenisBarangM::find($id);
        $model->delete();

        return redirect('jenisbarang');
    }
}
