<?php

namespace App\Http\Controllers;

use App\Models\Rekamedis;
use App\Models\ResepObat;
use App\Models\ResepObatDetail;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    
    public function index()
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }
        $transaksi = Transaksi::get();

        return view('pages.transaksi.index',compact('transaksi'));
    }


    public function createTransaksi($id)
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }
        $total = 0;

        // get rekamedis
        $rekammedis = Rekamedis::with('resepobat')->findOrFail($id);

        $resepObat = ResepObatDetail::where('id_resep_obat',$rekammedis->resepobat->id)
                        ->with('obat.kategori_obat')
                        ->get();
        

        foreach ($resepObat as $item ) {
            $total += $item->jumlah_obat * $item->obat->harga;
        }
       

        
        return view('pages.transaksi.create',compact('rekammedis','resepObat','total'));

    }

    public function store(Request $request)
    {

        // get data obat dan data rekamedis
        $rekammedis = Rekamedis::with('resepobat')->findOrFail($request->rekammedis_id);

        $resepObat = ResepObatDetail::where('id_resep_obat',$rekammedis->resepobat->id)
                        ->with('obat.kategori_obat')
                        ->get();
    
        // save to transaksi
        $transaksi = Transaksi::create([
            'no_regis' => $request->no_regis,
            'resep_obat_id' => $rekammedis->resep_obat_id,
            'pasien_id' => $rekammedis->pasien_id,
            'jasa_dokter' => $request->jasa_dokter,
            'bayar' => $request->jumlah_bayar,
            'kembalian' => $request->kembalian,
            'tanggal_periksa' => Carbon::parse($request->tanggal_periksa)->format('Y-m-d'),
            'tanggal_bayar' => Carbon::parse($request->tanggal_bayar)->format('Y-m-d'),
            'total' => $request->grandtotal,
            'rekammedis_id' => $rekammedis->id
        ]);
      
        foreach ($resepObat as $item ) {
            
              // save to detail
              $detail = TransaksiDetail::create(
                    [
                        'transaksi_id' => $transaksi->id,
                        'obat_id' => $item->id_obat,
                        'jumlah' => $item->jumlah_obat,
                        'subtotal' => $item->jumlah_obat * $item->obat->harga
                    ]
                );

                // kruangi produk di master
        }
        return redirect()->route('transaksi.index')->with('success','Data Berhasil Ditambahkan');

       
    }

    public function edit($id)
    {
        $total = 0;

        // get rekamedis
        $transaksi = Transaksi::with('rekammedis.resepobat')->findOrFail($id);

        $resepObat = ResepObatDetail::where('id_resep_obat',$transaksi->rekammedis->resepobat->id)
                        ->with('obat.kategori_obat')
                        ->get();
        

        foreach ($resepObat as $item ) {
            $total += $item->jumlah_obat * $item->obat->harga;
        }
       

        
        return view('pages.transaksi.edit',compact('transaksi','resepObat','total'));
    }

    public function update(Request $request , $id)
    {
          // get data obat dan data rekamedis
          $transaksi = Transaksi::with('rekammedis.resepobat')->findOrFail($id);

          $resepObat = ResepObatDetail::where('id_resep_obat',$transaksi->rekammedis->resepobat->id)
                          ->with('obat.kategori_obat')
                          ->get();
      
          // save to transaksi
          $transaksi->update([
              'no_regis' => $request->no_regis,
              'resep_obat_id' => $transaksi->rekammedis->resep_obat_id,
              'pasien_id' => $transaksi->pasien_id,
              'jasa_dokter' => $request->jasa_dokter,
              'bayar' => $request->jumlah_bayar,
              'kembalian' => $request->kembalian,
              'tanggal_periksa' => Carbon::parse($request->tanggal_periksa)->format('Y-m-d'),
              'tanggal_bayar' => Carbon::parse($request->tanggal_bayar)->format('Y-m-d'),
              'total' => $request->grandtotal,
          ]);
  
        
          foreach ($resepObat as $item ) {
                // save to detail
                $detail = TransaksiDetail::create(
                      [
                          'transaksi_id' => $transaksi->id,
                          'obat_id' => $item->id_obat,
                          'jumlah' => $item->jumlah_obat,
                          'subtotal' => $item->jumlah_obat * $item->obat->harga
                      ]
                  );
  
                  // kruangi produk di master
          }
  
    
  
          return redirect()->route('transaksi.index')->with('success','Data Berhasil Diubah');
    }

    public function listRekamMedis()
    {
        $userId = Auth::user()->id;
        $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
        $cek = $userRole->roles->nama;
        if ($cek == "pasien") {
            return redirect()->route('pasien_home');
        }elseif ($cek == "dokter") {
            return redirect()->route('dokter_home');
        }
        $rekammedis = Rekamedis::with(['pasien','dokter'])->doesntHave('transaksi')->get();
        

        return view('pages.transaksi.listrekammedis',compact('rekammedis'));

    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->transaksidetail()->delete();
        $transaksi->delete();

        return back()->with('success','Data Berhasil Dihapus');
    }

    public function print($id)
    {
        $total = 0;
          // get data obat dan data rekamedis
          $transaksi = Transaksi::with('rekammedis.resepobat')->findOrFail($id);

          $resepObat = ResepObatDetail::where('id_resep_obat',$transaksi->rekammedis->resepobat->id)
                          ->with('obat.kategori_obat')
                          ->get();
        foreach ($resepObat as $item ) {
            $total += $item->jumlah_obat * $item->obat->harga;
         }

         $data = [
           'total' => $total,
           'transaksi' => $transaksi,
           'resepObat' => $resepObat 
        ];

        $pdf = PDF::loadView('pages.transaksi.invoice.invoice', $data)->setPaper('a4', 'potrait');;
        return $pdf->download('Invoice Pemeriksaan.pdf');

        // return view('pages.transaksi.invoice.invoice',[
        //     'total' => $total,
        //    'transaksi' => $transaksi,
        //    'resepObat' => $resepObat 
        // ]);
    }



}
