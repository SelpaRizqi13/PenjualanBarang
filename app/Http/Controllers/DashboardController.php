<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangM;
use App\Models\JenisBarangM;
use App\Models\PenjualanBarangT;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenisbarang = JenisBarangM::count();
        $barang = BarangM::count();
        $penjualan = PenjualanBarangT::count();

        $penjualanPerJenisBarang = PenjualanBarangT::selectRaw('jenisbarang_id, SUM(jumlahyangdibeli) as total_terjual')
            ->groupBy('jenisbarang_id')
            ->orderByDesc('total_terjual')
            ->get();

        $maxPenjualan = $penjualanPerJenisBarang->first();
        $minPenjualan = $penjualanPerJenisBarang->last();

        $chartData = $penjualanPerJenisBarang->map(function($item) {
            return [
                'nama_jenisbarang' => $item->jenisbarang->nama_jenisbarang,
                'total_terjual' => $item->total_terjual,
            ];
        });

        return view('pages.dashboard.index', compact(
            'jenisbarang', 
            'barang', 
            'penjualan', 
            'maxPenjualan', 
            'penjualanPerJenisBarang',  
            'minPenjualan', 
            'chartData'
        ));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
