<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'motel' => 'Nhà trọ',
            'whole_house' => 'Nhà nguyên căn',
            'dormitory' => 'Ký túc xá',
            'other' => 'Khác',
        ];

        foreach ($categories as $category) {
            DB::table('house_categories')->insert(['name' => $category]);
        }
    }
}
