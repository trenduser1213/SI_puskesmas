<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Obat::insert([
            [
                'kode' => 'A1',
                'kategori_obat_id' => '1',
                'nama' => 'Gastrucid',
                'dosis' => '2x1',
                'harga' => '10000',
                'tanggal_produksi' => '2014-03-01',
                'tanggal_kadaluarsa' => '2016-03-01'
            ],
            [
                'kode' => 'A2',
                'kategori_obat_id' => '2',
                'nama' => 'Biogesic',
                'dosis' => '3x1',
                'harga' => '2000',
                'tanggal_produksi' => '2014-03-01',
                'tanggal_kadaluarsa' => '2016-03-01'
            ]
        ]);
    }
}
