<?php

namespace App\Http\Controllers;

use App\Models\Rekamedis;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    
    public function index()
    {
        $transaksi = Transaksi::get();

        return view('pages.transaksi.index',compact('transaksi'));
    }


    public function create()
    {
        $rekammedis = Rekamedis::get();
        return view('pages.transaksi.create',compact('rekammedis'));

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
        $rekammedis = Rekamedis::with(['user'])->doesntHave('transaksi')->get();

        return view('pages.transaksi.listrekammedis',compact('rekammedis'));

    }



}
