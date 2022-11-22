<?php

namespace App\Http\Controllers;

use App\Models\Rekamedis;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    
    public function index()
    {
        $transaksi = Transaksi::get();

        return view('pages.transaksi.index',compact('transaksi'));
    }


    public function createTransaksi($id)
    {
        $total = 0;
        // get rekamedis
        $rekammedis = Rekamedis::with('resepobat')->findOrFail($id);

        $resepObat = ResepObatDetail::where('id_resep_obat',$rekammedis->resepobat->id)
                        ->with('obat.kategori_obat')
                        ->get();
        

        foreach ($resepObat as $item ) {
            $count=  explode(" ",$item->jumlah_obat);
            $total +=$count[0] * $item->obat->harga;
        }
       

        
        return view('pages.transaksi.create',compact('rekammedis','resepObat','total'));

    }

    public function store(Request $request)
    {
        return view();
    }

    public function edit(Request $request)
    {
        
    }

    public function listRekamMedis()
    {
        $rekammedis = Rekamedis::with(['pasien','dokter'])->doesntHave('transaksi')->get();
        

        return view('pages.transaksi.listrekammedis',compact('rekammedis'));

    }



}
