<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'size' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'type' => $this->faker->randomElement(['Type A', 'Type B', 'Type C']),
        ];
    }
}

