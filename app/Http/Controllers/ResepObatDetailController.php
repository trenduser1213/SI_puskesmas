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

class ResepObatDetailController extends Controller
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
        
        $resep_obat_detail = ResepObatDetail::all();

        return view('pages.resep_obat_detail.index', compact('resep_obat_detail'));
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
        }elseif ($cek == "apoteker") {
            // # code...
        }

        $data = [
            'obat' => Obat::all(),
            'resep'
        ];

        return view('pages.resep_obat_detail.create', $data);
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
            'obat_id' => 'required',
            'keterangan_obat' => 'required',
            'jumlah_obat' => 'required',
        ]);
        // dd($request->all());
        $input = new ResepObatDetail();
        $input->id_resep_obat = $request->id;
        $input->id_obat = $request->obat_id;
        $input->keterangan_obat = $request->keterangan_obat;
        $input->jumlah_obat = $request->jumlah_obat;
        $input->save();

        return redirect()->back()->with("success", "Tambah data berhasil");
        // try {
        //     ResepObatDetail::create($request->all());
        //     return redirect('admin/resep_obat_detail')->with("success", "Tambah data berhasil");
        // } catch (\Exception $th) {
        //     return redirect()->back()->with('error', $th);
        // }

        // $input = new ResepObatDetail();
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
        }elseif ($cek == "apoteker") {
            // # code...
        }

        // $kode_obat = ResepObatDetail::findOrFail($id)->kode;

        // $obat_dipilih = DB::table('resep_obat_details')
        // ->join('obat', 'resep_obat_details.id_obat', '=', 'obat.id')
        // ->where('resep_obat_details.kode', $kode_obat)
        // ->select('resep_obat_details.*', 'obat.nama as nama_obat')
        // ->get();

        $data = [
            'resep_obat_detail' => ResepObatDetail::where('id_resep_obat_detail'),
            'main_resep_obat_detail' => ResepObatDetail::findOrFail($id),
            'obat' => Obat::all(),
        ];

        // dd($data);
        return view('pages.resep_obat_detail.update', $data);
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

        $input = ResepObatDetail::find($id);

        $input->update([
            'id_obat' => $request->obat_id,
            'keterangan_obat' => $request->keterangan_obat,
            'jumlah_obat' => $request->jumlah_obat,
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
        $resep_obat_detail = ResepObatDetail::findOrFail($id);
        $resep_obat_detail->delete();
        return redirect()->back()->with("success", "Hapus data berhasil");
    }
}
