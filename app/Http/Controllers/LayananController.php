<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\UserSpesialis;
use App\Models\UserRole;
use App\Models\Obat;
use App\Models\Spesialis;
use App\Models\PendaftaranPasien;
use Illuminate\Support\Facades\Auth;
use App\Mail\KirimNomorAntrianEmail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use PDF;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function berobat()
    {
        $data['jadwalSenin'] = JadwalDokter::with(['users'])->where('hari', 'senin')->get();
        $data['jadwalSelasa'] = JadwalDokter::with(['users'])->where('hari', 'selasa')->get();
        $data['jadwalRabu'] = JadwalDokter::with(['users'])->where('hari', 'rabu')->get();
        $data['jadwalKamis'] = JadwalDokter::with(['users'])->where('hari', 'kamis')->get();
        $data['jadwalJumat'] = JadwalDokter::with(['users'])->where('hari', 'jumat')->get();
        $data['jadwalSabtu'] = JadwalDokter::with(['users'])->where('hari', 'sabtu')->get();
        $data['jadwalMinggu'] = JadwalDokter::with(['users'])->where('hari', 'minggu')->get();
        return view('pages.pasien.berobat',$data);
    }

    public function pasien_mendaftar($id)
    {
        $userId = Auth::user()->id;
        $jadwal = JadwalDokter::with(['users'])->where('id', $id)->first();
        $nomor_antrian = $jadwal['nomor_antrian'] + 1;
        $jadwalUpdate = JadwalDokter::where('id', $id)->update(['nomor_antrian' => $nomor_antrian]);
        $pendaftaranPasien = PendaftaranPasien::create(['user_id' => $userId, 'nomor_antrian' => $nomor_antrian, 'status' => 'antri']);
        $public_path = 'qrcode/' . time() . '.svg';
        $url = url('/update-status-pendaftaran/' . $pendaftaranPasien->id);
        QrCode::generate($url, public_path($public_path) );
        $mailTo = Auth::user()->email;
        $nama = Auth::user()->nama;
        $data = [
            'nomor_antrian' => $nomor_antrian,
            'dokter' => $jadwal->users->nama,
            'waktu_mulai' => $jadwal->waktu_mulai,
            'waktu_selesai' => $jadwal->waktu_selesai,
            'ruangan' => $jadwal->ruangan,
            'qrcode' => $public_path
        ];
        $customPaper = array(0,0,400.00,283.80);
        $pdf = PDF::loadView('nomor_antrian_pdf', $data)->setPaper($customPaper, 'landscape');
        Mail::to($mailTo)->send(new KirimNomorAntrianEmail($nomor_antrian, $jadwal, $public_path, $nama));

        return $pdf->download('antrian.pdf');
    }

    public function update_status_pendaftaran($id)
    {
        $pendaftaran = PendaftaranPasien::where('id', $id)->update(['status' => 'sudah dilayani']);
        $data['obat'] = Obat::count();
        $data['dokter'] = UserSpesialis::count();
        $data['pasien'] = UserRole::where('role_id', 3)->count();
        $data['spesialis'] = Spesialis::count();
        return view('pages.dashboard.dashboard', $data);
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
