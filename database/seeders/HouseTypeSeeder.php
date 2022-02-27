<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'room_cover' => 'Bao phòng',
            'dormitory' => 'Ký túc xá'
        ];

        foreach ($types as $type) {
            DB::table('house_types')->insert(['name' => $type]);
        }
    }
}
