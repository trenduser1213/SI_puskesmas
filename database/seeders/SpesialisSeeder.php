<?php

namespace Database\Seeders;

use App\Models\Spesialis;
use Illuminate\Database\Seeder;

class SpesialisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Spesialis::insert([
           [
               'kode' => 'SP001',
               'nama' => 'Penyakit Dalam',
           ]
        ]);
    }
}
