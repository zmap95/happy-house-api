<?php

namespace Database\Seeders;

use App\Entities\House;
use App\Entities\HouseAmenity;
use App\Entities\Utility;
use Illuminate\Database\Seeder;

class HouseAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $utilities = Utility::all();
        $count     = count($utilities);
        $houseIds  = House::pluck('id');
        foreach ($houseIds as $id) {
            $utility = $utilities[rand(1, $count - 1)];
            HouseAmenity::create([
                'name' => $utility['name'],
                'icon' => $utility['icon'],
                'house_id' => $id
            ]);
        }
    }
}
