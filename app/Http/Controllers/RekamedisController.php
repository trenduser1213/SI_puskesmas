<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Rekamedis;
use App\Models\UserRole;
use App\Models\Roles;

class RekamedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $rekamedis = Rekamedis::with([
            'pasien',
            'dokter',
            'resepobat.resepobatdetails.obat',
            'rujukans.tempatRujukan',
            'rujukans.dokterspesialis.user_spesialis'
        ])->get();
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
        $obats = Obat::all();
        return view('pages.rekamedis.create', compact('dokter', 'pasien', 'obats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $rekamedis = null;
            if ($request->filled(['kode', 'tanggal_resep'])) {
                // Add new Resep Obat in Rekam Medis page
                $resepObat = new ResepObat();
                $resepObat->kode = $request->kode;
                $resepObat->tanggal_resep = $request->tanggal_resep;
                $resepObat->save();

                if ($request->filled(['tanggal_pendaftaran'])) {    // If Resep Obat added in create page
                    $request->request->add(['resep_obat_id' => $resepObat->id]);
                    $rekamedis = Rekamedis::create($request->except(['kode', 'tanggal_resep']));
                } elseif ($request->has(['rekam_medis_id'])) {  // If Resep Obat added in edit page
                    $rekamedis = Rekamedis::findOrFail($request->rekam_medis_id);
                    $rekamedis->update(['resep_obat_id' => $resepObat->id]);
                }
            } else {
                $rekamedis = Rekamedis::create($request->all());
            }
            return redirect()->route('rekamedis.edit', $rekamedis->id)->with("success", "Tambah data berhasil");
        } catch (\Exception $th) {
            return redirect()->back()->withInput()->with('error', "Isi field dengan benar");
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
        $rekamedis = Rekamedis::with([
            'pasien',
            'dokter',
            'resepobat.resepobatdetails.obat',
        ])->findOrFail($id);
        $roleDokter = Roles::where('nama', 'dokter')->first();
        $rolePasien = Roles::where('nama', 'pasien')->first();
        $dokter = UserRole::with(['users', 'roles'])->where('role_id', $roleDokter->id)->get();
        $pasien = UserRole::with(['users', 'roles'])->where('role_id', $rolePasien->id)->get();
        $obats = Obat::all();
        return view('pages.rekamedis.update', compact('rekamedis', 'dokter', 'pasien', 'obats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $req = $request->except('_method', '_token', 'submit');
        try {
            Rekamedis::findOrFail($id)->update($request->all());
            return redirect()->back()->with("success", "Update data berhasil");
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
