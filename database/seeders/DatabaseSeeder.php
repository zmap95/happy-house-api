<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VietNamLocationSeeder::class);
        $this->call(HouseCategorySeeder::class);
        $this->call(HouseTypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(HouseSeeder::class);
        $this->call(FeeCategorySeeder::class);
        $this->call(UtilitySeeder::class);
        $this->call(HouseAmenitySeeder::class);
        $this->call(FeeLevelSeeder::class);
    }
}
