<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'no_regis',
        'resep_id',
        'no_regis',
        'pasien_id',
        'tanggal_periksa',
        'tanggal_bayar',
        'total',
        'nomor_antrian',
        'rekammedis_id'
    ];

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'resep_id', 'id');
    }


   
    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id', 'id');
    }
}
