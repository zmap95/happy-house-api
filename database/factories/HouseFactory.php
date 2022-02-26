<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class HouseFactory extends Factory
{
    protected $model = \App\Entities\House::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "House " . $this->faker->unique()->numberBetween(1, 99999),
            'category_id' => Arr::random(config('constant.house.categories')),
            'type_id' => Arr::random(config('constant.house.types')),
            'address' => $this->faker->streetAddress,
            'province_id' => 1,
            'district_id' => 1,
            'commune_id' => 1,
            'common_fee' => Arr::random(['all_room', 'separate']),
            'electricity_per_kwh' => rand(1000, 4000),
            'water_per_block' => rand(1000, 4000),
            'electricity_closing_date' => rand(1, 31),
            'water_closing_date' => rand(1, 31),
            'public_community_status' => Arr::random(['visible', 'invisible']),
            'status' => 'active',
            'description' => $this->faker->randomHtml,
            'user_id' => 1,
        ];
    }
}
