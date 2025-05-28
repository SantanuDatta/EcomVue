<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
        $title = fake()->sentence(5);

        return [
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => str($title)->slug(),
            'description' => fake()->paragraph(),
            'is_active' => fake()->boolean(60),
        ];
    }
}
