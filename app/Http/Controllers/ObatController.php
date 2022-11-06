<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\KategoriObat;
use App\Http\Requests\ObatRequest;
use App\Http\Requests\ObatUpdateRequest;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obat = Obat::with(['kategori_obat'])->get();
        return view('pages.obat.index', compact('obat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori_obat = KategoriObat::all();
        return view('pages.obat.create', compact('kategori_obat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObatRequest $request)
    {
        try {
            Obat::create($request->all());
            return redirect()->back()->with("success", "Tambah data berhasil");
        } catch (\Exception $th) {
            return redirect()->back()->with('error', "Isi field dengan benar");
        }
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
        $obat = Obat::with(['kategori_obat'])->findOrFail($id);
        $kategori_obat = KategoriObat::all();
        return view('pages.obat.update', compact('obat', 'kategori_obat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ObatUpdateRequest $request, $id)
    {
        $req = $request->except('_method', '_token', 'submit');
        try {
            Obat::findOrFail($id)->update($request->all());
            return redirect()->route('obat.index')->with("success", "Update data berhasil");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "Update gagal");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
