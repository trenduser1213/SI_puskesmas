<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPasien extends Model
{
    use HasFactory;
    public $table = 'pendaftaran_pasien';

    protected $fillable = [
        'user_id',
        'nomor_antrian',
        'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
