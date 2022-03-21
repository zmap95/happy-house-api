<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('utilities')->insert([
            ['name' => 'Tủ lạnh', 'icon' => 'fas fa-refrigerator', 'user_id' => 1],
            ['name' => 'Giường', 'icon' => 'fad fa-bed', 'user_id' => 1],
            ['name' => 'Tử quần áo', 'icon' => 'fas fa-cabinet-filing', 'user_id' => 1],
            ['name' => 'Bếp', 'icon' => 'far fa-hat-chef', 'user_id' => 1],
            ['name' => 'Nhà gửi xe', 'icon' => 'fad fa-garage', 'user_id' => 1],
        ]);
    }
}
