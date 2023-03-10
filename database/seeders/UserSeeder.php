<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
   
    public function run()
    {
        $admin = User::create([
            'username' => 'Admin',
            'nama' => 'admin',
            'email' => 'admin',
            'tanggal_lahir' => '1971-03-01',
            'jenis_kelamin' => 'L',
            'password' => bcrypt('admin'),
        ]);

        $params['user_id'] = $admin->id;
        $params['role_id'] = 1;
        $userRole = UserRole::create($params);

        $dokter = User::create([
            'username' => 'dokter',
            'nama' => 'dokter',
            'email' => 'dokter',
            'tanggal_lahir' => '1971-03-02',
            'jenis_kelamin' => 'P',
            'password' => bcrypt('dokter'),
        ]);

        $dokterarray['user_id'] = $dokter->id;
        $dokterarray['role_id'] = 2;
        $userRole = UserRole::create($dokterarray);

        $pasien = User::create([
            'username' => 'pasien',
            'nama' => 'pasien',
            'email' => 'pasien@gmail.com',
            'tanggal_lahir' => '1971-03-03',
            'jenis_kelamin' => 'L',
            'no_rm' => '00001',
            'password' => bcrypt('pasien'),
        ]);

        $paseinarray['user_id'] = $pasien->id;
        $paseinarray['role_id'] = 3;
        $userRole = UserRole::create($paseinarray);

        $pasien = User::create([
            'username' => 'apoteker',
            'nama' => 'apoteker',
            'email' => 'apoteker',
            'jenis_kelamin' => 'P',
            'password' => bcrypt('apoteker'),
        ]);

        $paseinarray['user_id'] = $pasien->id;
        $paseinarray['role_id'] = 4;
        $userRole = UserRole::create($paseinarray);

        $pasien2 = User::create([
            'nama' => 'Mara',
            'username' => 'mara',
            'email' => 'mara',
            'tanggal_lahir' => '1971-02-02',
            'jenis_kelamin' => 'P',
            'no_rm' => '00002',
            'password' => bcrypt('mara'),
        ]);

        $pasien2data['user_id'] = $pasien2->id;
        $pasien2data['role_id'] = 3;
        $userRole = UserRole::create($pasien2data);

        $dokter2 = User::create([
            'username' => 'dokter2',
            'nama' => 'dokter2',
            'email' => 'dokter2',
            'tanggal_lahir' => '1971-03-02',
            'jenis_kelamin' => 'P',
            'password' => bcrypt('dokter2'),
        ]);

        $dokterarray2['user_id'] = $dokter2->id;
        $dokterarray2['role_id'] = 2;
        $userRole = UserRole::create($dokterarray2);

        $dokter3 = User::create([
            'username' => 'dokter3',
            'nama' => 'dokter3',
            'email' => 'dokter3',
            'tanggal_lahir' => '1971-03-02',
            'jenis_kelamin' => 'P',
            'password' => bcrypt('dokter3'),
        ]);

        $dokterarray3['user_id'] = $dokter3->id;
        $dokterarray3['role_id'] = 2;
        $userRole = UserRole::create($dokterarray3);

    }
}
