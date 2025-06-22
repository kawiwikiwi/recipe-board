<?php

namespace Database\Factories;

use App\DifficultyEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'makes' => $this->faker->numberBetween(1, 6),
            'serves' => $this->faker->numberBetween(1, 6),
            'difficulty' => $this->faker->randomElement(DifficultyEnum::cases())->value,
            'description' => $this->faker->paragraph(),
            'is_published' => $this->faker->boolean(50),
            'cook_time' => $this->faker->numberBetween(1, 8) . ':' . $this->faker->numberBetween(0, 59),
            'prep_time' => $this->faker->numberBetween(1, 8) . ':' . $this->faker->numberBetween(0, 59),
        ];
    }
}
