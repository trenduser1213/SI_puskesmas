<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekamedis;
use App\Models\UserRole;
use App\Models\Roles;

class RekamedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rekamedis = Rekamedis::with(['pasien', 'dokter'])->get();
        return view('pages.rekamedis.index', compact('rekamedis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleDokter = Roles::where('nama', 'dokter')->first();
        $rolePasien = Roles::where('nama', 'pasien')->first();
        $dokter = UserRole::with(['users', 'roles'])->where('role_id', $roleDokter->id)->get();
        $pasien = UserRole::with(['users', 'roles'])->where('role_id', $rolePasien->id)->get();
        return view('pages.rekamedis.create', compact('dokter', 'pasien'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Rekamedis::create($request->all());
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
        $rekamedis = Rekamedis::with(['pasien', 'dokter'])->findOrFail($id);
        $roleDokter = Roles::where('nama', 'dokter')->first();
        $rolePasien = Roles::where('nama', 'pasien')->first();
        $dokter = UserRole::with(['users', 'roles'])->where('role_id', $roleDokter->id)->get();
        $pasien = UserRole::with(['users', 'roles'])->where('role_id', $rolePasien->id)->get();
        return view('pages.rekamedis.update', compact('rekamedis', 'dokter', 'pasien'));
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
        $req = $request->except('_method', '_token', 'submit');
        try {
            Rekamedis::findOrFail($id)->update($request->all());
            return redirect()->route('rekamedis.index')->with("success", "Update data berhasil");
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
        $rekamedis = Rekamedis::findOrFail($id);
        $rekamedis->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
