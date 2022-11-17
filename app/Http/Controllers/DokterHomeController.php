<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Roles;
use App\Models\Spesialis;
use App\Models\UserSpesialis;
use App\Models\JadwalDokter;
use App\Http\Requests\JadwalDokterRequest;
use Illuminate\Support\Facades\Auth;

class DokterHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "apoteker") {
            // # code...
        }
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $data['role'] = $userRole->roles->nama;
        $data['obat'] = Obat::count();
        $data['dokter'] = UserSpesialis::count();
        $data['pasien'] = UserRole::where('role_id', 3)->count();
        $data['spesialis'] = Spesialis::count();
        return view('pages.dashboard.dokter_dashboard', $data);
    }

    public function jadwal_dokter()
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "apoteker") {
            // # code...
        }
        $data['jadwalSenin'] = JadwalDokter::with(['users'])->where('hari', 'senin')->get();
        $data['jadwalSelasa'] = JadwalDokter::with(['users'])->where('hari', 'selasa')->get();
        $data['jadwalRabu'] = JadwalDokter::with(['users'])->where('hari', 'rabu')->get();
        $data['jadwalKamis'] = JadwalDokter::with(['users'])->where('hari', 'kamis')->get();
        $data['jadwalJumat'] = JadwalDokter::with(['users'])->where('hari', 'jumat')->get();
        $data['jadwalSabtu'] = JadwalDokter::with(['users'])->where('hari', 'sabtu')->get();
        $data['jadwalMinggu'] = JadwalDokter::with(['users'])->where('hari', 'minggu')->get();

        return view('pages.dokter.jadwal', $data);
    }

    public function form_jadwal_dokter()
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "apoteker") {
            // # code...
        }
        $role = Roles::where('nama', 'dokter')->first();
        $spesialis = Spesialis::all();
        $dokter = UserRole::with(['users', 'roles'])->where('role_id', $role->id)->get();

        return view('pages.dokter.create_jadwal', compact('dokter'));
    }

    public function delete_jadwal_dokter($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        $jadwal->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }

    public function buat_jadwal_dokter(JadwalDokterRequest $request)
    {
        $jadwal = JadwalDokter::create($request->all());

        return redirect()->back()->with("success", "Buat data berhasil");
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
