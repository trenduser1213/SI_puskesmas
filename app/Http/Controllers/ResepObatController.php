<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ResepObatRequest;
use App\Http\Requests\ResepObatUpdateRequest;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;

class ResepObatController extends Controller
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
        
        $resep_obat = ResepObat::all();

        return view('pages.resep_obat.index', compact('resep_obat'));
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

        $data = [
            'obat' => Obat::all(),
        ];

        return view('pages.resep_obat.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'tanggal_resep' => 'required',
            // 'obat_id' => 'required',
            // 'keterangan_obat' => 'required',
            // 'jumlah_obat' => 'required',
        ]);

        $input = new ResepObat();
        $input->kode = $request->kode;
        $input->tanggal_resep = $request->tanggal_resep;
            // $input->id_obat = $request->obat_id;
            // $input->keterangan_obat = $request->keterangan_obat;
            // $input->jumlah_obat = $request->jumlah_obat;
        $input->save();

        return redirect('admin/resep_obat/'.$input->id.'/edit')->with("success", "Tambah data berhasil");
        // try {
        //     ResepObat::create($request->all());
        //     return redirect('admin/resep_obat')->with("success", "Tambah data berhasil");
        // } catch (\Exception $th) {
        //     return redirect()->back()->with('error', $th);
        // }

        // $input = new ResepObat();
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

        // $kode_obat = ResepObat::findOrFail($id)->kode;

        $obat_dipilih = DB::table('resep_obat_details')
        ->join('obat', 'resep_obat_details.id_obat', '=', 'obat.id')
        ->where('resep_obat_details.id_resep_obat', $id)
        ->select('resep_obat_details.*', 'obat.nama as nama_obat')
        ->get();

        // dd($obat_dipilih);

        $data = [
            'resep_obat' => $obat_dipilih,
            'main_resep_obat' => ResepObat::findOrFail($id),
            'obat' => Obat::all(),
            'resep_obat_id' => $id, 
        ];

        // dd($data);
        return view('pages.resep_obat.update', $data);
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
        $input = ResepObat::find($id);

        $input->update([
            'kode' => $request->kode,
            'tanggal_resep' => $request->tanggal_resep,
        ]);

        return redirect()->back()->with("success", "Update data berhasil");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resep_obat = ResepObat::findOrFail($id);
        $resep_obat->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
