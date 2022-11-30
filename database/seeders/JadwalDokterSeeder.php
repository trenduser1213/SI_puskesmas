<?php

namespace Database\Seeders;

use App\Models\JadwalDokter;
use Illuminate\Database\Seeder;

class JadwalDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JadwalDokter::create([
            'dokter_id' => 2,
            'hari' => 'selasa',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301"
        ]);

        JadwalDokter::create([
            'dokter_id' => 2,
            'hari' => 'rabu',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301"
        ]);

        JadwalDokter::create([
            'dokter_id' => 2,
            'hari' => 'kamis',
            'waktu_mulai' => "08:00",
            'waktu_selesai'=> "17:00",
            'ruangan' => "A301"
        ]);


    }
}
