<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianObatSuppliers extends Model
{
    use HasFactory;

    public $table = 'pembelian_obat_suppliers';
    protected $fillable = [
        'obat_id',
        'stok',
        'sisa_obat',
        'tanggalproduksi',
        'tanggalkadaluarsa'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
