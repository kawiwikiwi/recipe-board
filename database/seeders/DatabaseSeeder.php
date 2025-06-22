<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create(
            [
                'name' => 'Test User',
                'email' => 'testuser@test.com',
                'password' => Hash::make('password'),
                'username' => 'testuser',
            ]
        );

        // User::factory(1)->create()->each(function ($user) {
        //     Recipe::factory(1)->create([
        //         'user_id' => $user->id,
        //     ]);
        // });

        // Recipe::create([
        //     'user_id' => User::first()->id,
        //     'title' => 'Spaghetti Carbonara',
        //     'makes' => 4,
        //     'serves' => 4,
        //     'cook_time' => '00:20',
        //     'prep_time' => '00:10',
        //     'difficulty' => 'easy',
        //     'description' => 'A classic Italian pasta dish made with eggs, cheese, pancetta, and pepper.',
        //     'is_published' => true,
        // ])->ingredient()->createMany([
        //     ['name' => 'Spaghetti', 'quantity' => 400, 'unit' => 'grams'],
        //     ['name' => 'Pancetta', 'quantity' => 150, 'unit' => 'grams'],
        //     ['name' => 'Eggs', 'quantity' => 3, 'unit' => 'large'],
        //     ['name' => 'Parmesan cheese', 'quantity' => 100, 'unit' => 'grams'],
        //     ['name' => 'Black pepper', 'quantity' => 1, 'unit' => 'teaspoon'],	
        // ]);
    }
}
