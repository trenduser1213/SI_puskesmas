<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPasien extends Model
{
    use HasFactory;
    public $table = 'appointments';

    protected $fillable = [
        'user_id',
        'nomor_antrian',
        'status',
        'dokter_id',
        'tanggal'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }
}
