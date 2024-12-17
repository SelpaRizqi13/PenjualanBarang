<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JanjiTemuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= Appointment::all();
        return view('pages.janji_temu.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model= new Appointment();
        $user = User::all();
        $timezones = timezone_identifiers_list();
        return view('pages.janji_temu.create', compact('model','user', 'timezones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $start = Carbon::parse($request->waktu_awal);
        $end = Carbon::parse($request->waktu_akhir);

        if (!$this->isWorkHours($start, $end)) {
            return back()->withErrors('Waktu janji temu harus berada di jam kerja (08:00 - 17:00).');
        }
        $model = new Appointment();
        $model->judul = $request->judul;
        $model->creator_id = $request->creator_id;
        
        $model->createloginpemakai_id = Auth::id();
        $model->waktu_awal = $start;
        $model->waktu_akhir = $end;
        $model->save();
        // dd($model->creator_id);

        return redirect('janjitemu')->with('success', 'Janji temu berhasil dibuat.');
    
    }

    // Cek apakah waktu dalam jam kerja
    private function isWorkHours($start, $end)
    {
        return $start->hour >= 8 && $end->hour <= 17;
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
