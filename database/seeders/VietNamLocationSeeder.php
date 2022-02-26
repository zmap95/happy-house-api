<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VietNamLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->truncate();
        $path = public_path('data/provinces.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);

        DB::table('districts')->truncate();
        $path = public_path('data/district.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);

        DB::table('communes')->truncate();
        $path = public_path('data/commune.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
