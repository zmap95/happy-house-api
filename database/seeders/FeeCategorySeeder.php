<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Điện luỹ tiến',
                'unit' => 'Đồng/Kwh',
                'type' => 'volatility'
            ],
            [
                'name' => 'Điện cố định theo đồng hồ',
                'unit' => 'Đồng/Kwh',
                'type' => 'fixed'
            ],
            [
                'name' => 'Điện cố định theo người',
                'unit' => 'Đồng/Người',
                'type' => 'fixed'
            ],
            [
                'name' => 'Điện biến động',
                'unit' => 'Đồng/Kwh',
                'type' => 'fixed'
            ],
            [
                'name' => 'Nước luỹ tiến',
                'unit' => 'Đồng/Khối',
                'type' => 'volatility'
            ],
            [
                'name' => 'Điện cố định theo đồng hồ',
                'unit' => 'Đồng/Khối',
                'type' => 'fixed'
            ],
            [
                'name' => 'Điện cố định theo người',
                'unit' => 'Đồng/Khối',
                'type' => 'fixed'
            ],
            [
                'name' => 'Điện biến động',
                'unit' => 'Đồng/Khối',
                'type' => 'fixed'
            ],
            [
                'name' => 'Gửi xe',
                'unit' => 'Đồng/Chiếc/Tháng',
                'type' => 'fixed'
            ],
            [
                'name' => 'Vệ sinh',
                'unit' => 'Đồng/Tháng',
                'type' => 'fixed'
            ],
            [
                'name' => 'Mạng internet',
                'unit' => 'Đồng/Tháng',
                'type' => 'fixed'
            ],
            [
                'name' => 'Phí quản lý',
                'unit' => 'Đồng/Tháng',
                'type' => 'fixed'
            ],
            [
                'name' => 'Phí biến động khác',
                'unit' => 'Đồng/Tháng',
                'type' => 'fixed'
            ],
            [
                'name' => 'Dịch vụ khác',
                'unit' => 'Đồng/Tháng',
                'type' => 'fixed'
            ]
        ];

        foreach ($categories as $category) {
            DB::table('fee_categories')->insert($category);
        }
    }
}
