<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feeLevels = [
            ['level' => 1],
            ['level' => 2],
            ['level' => 3],
            ['level' => 4],
            ['level' => 5],
            ['level' => 6],
            ['level' => 7]
        ];
        DB::table('fee_levels')->insert($feeLevels);
    }
}
