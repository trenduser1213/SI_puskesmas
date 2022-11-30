<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AntrianPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Show data for related dokter_id
        $appointments = PendaftaranPasien::whereStatus(PendaftaranPasien::STATUS_ANTRI)->whereDokterId(Auth::user()->id)->with(['users'])->get();
        $data = ['appointments' => $appointments];
        return view('pages.rekamedis.appointment', $data);
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

    public function batal(Request $request, $id)
    {
        $antrian = PendaftaranPasien::whereId($id)->with(['users'])->firstOrFail();
        $antrian->status = PendaftaranPasien::STATUS_BATAL;
        if ($antrian->save()) {
            return redirect()->route('pasien.index')->with("success", ['status' =>"Sukses!", 'content' => "Antrian berhasil dibatalkan!"]);
        }
    }
}
