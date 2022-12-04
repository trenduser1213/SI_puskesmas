<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriObat;
use App\Http\Requests\ObatRequest;
use App\Http\Requests\ObatUpdateRequest;
use App\Models\Transaksi;
use App\Models\ResepObatDetail;

class ObatController extends Controller
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
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }
        
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
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }
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
            return redirect('/admin/obat')->with("success", "Tambah data berhasil");
        } catch (\Exception $th) {
            return redirect()->back()->with('error', $th);
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
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }elseif ($cek == "apoteker") {
            return redirect()->route('apoteker_home');
        }
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

    
    public function destroy($id)
    {
        $resepObat = ResepObatDetail::where('id_obat', $id)->get();
        $obat = Obat::findOrFail($id);
        if ($resepObat) {
            return redirect()->back()->with("error", "Hapus data tidak berhasil, karena Obat sudah digunakan di Resep Obat dan Transaksi");
        }
        else {
            $obat->delete();
            return redirect()->back()->with("success", "Hapus data berhasil");
        }
    }
}
