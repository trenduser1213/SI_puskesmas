<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\PendaftaranPasien;
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
use App\Models\TempatRujukan;
use Illuminate\Support\Facades\Auth;

class RekamedisController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "admin") {
            return redirect()->route('home');
        }elseif ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }
        $rekamedis = Rekamedis::with([
            'pasien',
            'dokter',
            'resepobat.resepobatdetails.obat',
            'rujukans.tempatRujukan',
            'rujukans.dokterspesialis.user_spesialis'
        ])->get();
        $tempat = TempatRujukan::all();
        // dd($rekamedis->rujukans->last()->dokterspesialis->user_spesialis->nama);
        return view('pages.rekamedis.index', compact('rekamedis', 'tempat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "admin") {
            return redirect()->route('home');
        }elseif ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }
        $pasien_id = $request->id;
        $antrian = PendaftaranPasien::where('user_id', $pasien_id)->whereStatus(PendaftaranPasien::STATUS_ANTRI)->firstOrFail();
        $pasien = UserRole::with(['users', 'roles'])->where('user_id', $pasien_id)->first();
        $roleDokter = Roles::where('nama', 'dokter')->first();
        $obats = Obat::all();
        return view('pages.rekamedis.create', compact('antrian', 'pasien', 'obats'));
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
                    $request->request->add([
                        'resep_obat_id' => $resepObat->id,
                        'dokter_id' => Auth::user()->id,
                    ]);
                    $rekamedis = Rekamedis::create($request->except(['kode', 'tanggal_resep']));
                } elseif ($request->has(['rekam_medis_id'])) {  // If Resep Obat added in edit page
                    $rekamedis = Rekamedis::findOrFail($request->rekam_medis_id);
                    $rekamedis->update(['resep_obat_id' => $resepObat->id]);
                }
            } else {
                $request->request->add(['dokter_id' => Auth::user()->id]);
                $rekamedis = Rekamedis::create($request->all());
            }
            if ($rekamedis && $request->has('appointment_id')) {
                $appointment = PendaftaranPasien::whereId($request->appointment_id)->first();
                $appointment->status = PendaftaranPasien::STATUS_TELAH_DIPERIKSA;
                $appointment->save();
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
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "admin") {
            return redirect()->route('home');
        }elseif ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }
        $rekamedis = Rekamedis::with([
            'pasien',
            'dokter',
            'resepobat.resepobatdetails.obat',
        ])->findOrFail($id);
        $roleDokter = Roles::where('nama', 'dokter')->first();
        $rolePasien = Roles::where('nama', 'pasien')->first();
        $pasien = UserRole::with(['users', 'roles'])->where('role_id', $rolePasien->id)->get();
        $obats = Obat::all();
        $tempat = TempatRujukan::all();
        return view('pages.rekamedis.update', compact('rekamedis', 'pasien', 'obats', 'tempat'));
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
