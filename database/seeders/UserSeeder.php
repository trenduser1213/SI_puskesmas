<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([            
            'username' => 'Admin',
            'nama' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('admin'),                        
        ]); 

        $params['user_id'] = $admin->id;
        $params['role_id'] = 1;
        $userRole = UserRole::create($params);

        $dokter = User::create([            
            'username' => 'dokter',
            'nama' => 'dokter',
            'email' => 'dokter',
            'password' => bcrypt('dokter'),                        
        ]); 

        $dokterarray['user_id'] = $dokter->id;
        $dokterarray['role_id'] = 2;
        $userRole = UserRole::create($dokterarray);

        $pasien = User::create([            
            'username' => 'pasien',
            'nama' => 'pasien',
            'email' => 'pasien',
            'password' => bcrypt('pasien'),                        
        ]); 

        $paseinarray['user_id'] = $pasien->id;
        $paseinarray['role_id'] = 1;
        $userRole = UserRole::create($paseinarray);

    }
}
