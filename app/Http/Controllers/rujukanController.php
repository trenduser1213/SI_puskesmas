<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RujukanLab;
use App\Models\Rekamedis;
use App\Models\TempatRujukan;

class rujukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RujukanLab::with(['pasien'],['dokter'],['tempatRujukan'])->get();
        // dd($data);
        return view('pages.rujukan.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rekamedis  = Rekamedis::all();
        $tempat     = TempatRujukan::all();
        // dd($rekamedis);
        $data = [
            'rekamedis' => $rekamedis,
            'tempat'    => $tempat
        ];

        return view('pages.rujukan.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'kode'      => 'required',
            'jenis_pemeriksaan' =>'required',
            'rekamedis' => 'required',
            'tempat_rujukan_id' => 'required',
        ]);
        $rekamedis = Rekamedis::with(['pasien'],['dokter'])->find($request->rekamedis)->first();
        $idPasien = $rekamedis->pasien->id;
        $idDokter = $rekamedis->dokter->id;
        // dd($id);
        $input = new RujukanLab();
        $input->kode = $request->kode; 
        $input->jenis_pemeriksaan = $request->jenis_pemeriksaan; 
        $input->pasien_id = $idPasien; 
        $input->tempat_rujukan_id = $request->tempat_rujukan_id; 
        $input->dokter_id = $idDokter; 
        $input->rekamedis_id = $request->rekamedis; 
        $input->save();
        return redirect()->back()->with("success", "Data berhasil ditambahkan");
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
        $rekamedis  = Rekamedis::all();
        $tempat     = TempatRujukan::all();
        $val        = RujukanLab::with(['pasien'],['dokter'],['tempatRujukan'])->find($id)->first();

        // dd($rekamedis);
        $data = [
            'val'       => $val,
            'rekamedis' => $rekamedis,
            'tempat'    => $tempat
        ];

        return view('pages.rujukan.edit',$data);
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
        $input = RujukanLab::find($id);
        if($request->kode){
            $input->kode = $request->kode;
        }
        if ($request->jenis_pemeriksaan) {
            $input->jenis_pemeriksaan = $request->jenis_pemeriksaan;
        }
        if($request->rekamedis){
            $rekamedis = Rekamedis::with(['pasien'],['dokter'])->find($request->rekamedis)->first();
            $idPasien = $rekamedis->pasien->id;
            $idDokter = $rekamedis->dokter->id;
            $input->pasien_id = $idPasien;
            $input->dokter_id = $idDokter; 
            $input->rekamedis_id = $request->rekamedis;
        }
        $input->update();
        return redirect()->back()->with("success", "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $input = RujukanLab::find($id);
        $input->delete();
        return redirect()->back()->with("success", "Data berhasil dihapus");
        // dd($input); 
    }
}
