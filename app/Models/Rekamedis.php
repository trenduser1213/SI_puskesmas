<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekamedis extends Model
{
    use HasFactory;
    public $table = 'rekamedis';
    protected $fillable = [
        'tanggal_pendaftaran',
        'diagnosa',
        'tindakan',
        'pasien_id',
        'dokter_id',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'rekammedis_id');
    }

}
