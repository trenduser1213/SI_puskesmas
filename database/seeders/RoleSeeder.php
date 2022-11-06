<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert([
                'nama' => "admin",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ]);
        DB::table('roles')->insert([
            'nama' => "dokter",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('roles')->insert([
            'nama' => "pasien",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
