<?php

namespace Database\Seeders;

use App\Models\UserSpesialis;
use Illuminate\Database\Seeder;

class UserSpesialisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserSpesialis::insert([
            [
                'user_id' => 2,
                'spesialis_id' => 1,
            ],
        ]);

        UserSpesialis::insert([
            [
                'user_id' => 2,
                'spesialis_id' => 2,
            ],
        ]);

        UserSpesialis::insert([
            [
                'user_id' => 2,
                'spesialis_id' => 3,
            ],
        ]);
    }
}
