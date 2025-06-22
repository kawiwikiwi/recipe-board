<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1)->create()->each(function ($user) {
            // $user->recipes()->saveMany(\App\Models\Recipe::factory(5)->make());
        });
    }
}
