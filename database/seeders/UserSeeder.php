<?php

namespace Database\Seeders;

use App\Entities\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(1)->create(['email' => 'user@gmail.com', 'status' => 'active']);
        User::factory()->count(50)->create();
    }
}
