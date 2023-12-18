<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomDate = $this->faker->dateTimeBetween("-1 year");
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(10, 10000) * 1000,
            'time_used' => $this->faker->numberBetween(1, 36),
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement([0, 1, 2]),
            'user_id' => User::all()->random()->user_id,
            'created_at' => $randomDate,
            'updated_at' => $randomDate,
        ];
    }
}
