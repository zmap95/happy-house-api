<?php

namespace Database\Seeders;

use App\Entities\House;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            $province = rand(1, 63);
            $district = DB::table('districts')->where('province_id', $province)->inRandomOrder()->first();
            $commune = DB::table('communes')->where('district_id', $district->id)->inRandomOrder()->first();

            House::factory()->count(5)->create([
                'user_id' => $user->id,
                'province_id' => $province,
                'district_id' => $district->id,
                'commune_id' => $commune->id,
            ]);
        }
    }
}
