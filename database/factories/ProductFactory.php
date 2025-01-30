<?php

declare(strict_types=1);

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
        return [
            'title' => fake()->unique()->sentence(3),
            'image' => 'https://picsum.photos/400/?seed='. rand(1, 100),
            'description' => fake()->realText(1000),
            'price' => random_int(500, 2000),
            'created_by' => User::factory(),
        ];
    }
}
