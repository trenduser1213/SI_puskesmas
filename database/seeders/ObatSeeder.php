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
                'stok' => 99
            ],
            [
                'kode' => 'A2',
                'kategori_obat_id' => '2',
                'nama' => 'Biogesic',
                'dosis' => '3x1',
                'harga' => '2000',
                'stok' => 99
            ]
        ]);
    }
}
