<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        return [
            'title' => fake()->unique()->sentence(3),
            'image' => null,
            'description' => fake()->realText(1000),
            'price' => random_int(500, 2000),
            'created_by' => User::factory(),
        ];
    }

    /**
     * Configure the factory to add a product image after creating the product.
     *
     * @return Factory<Product>
     */
    public function withProductImage(): Factory|self
    {
        return $this->afterCreating(function (Product $product): void {
            $url = 'https://picsum.photos/400/?seed='.random_int(1, 1000);
            $imageData = file_get_contents($url);
            $filename = 'products/'.uniqid().'.jpg';
            Storage::disk('public')->put($filename, $imageData);
            $product->update(['image' => $filename]);
        });
    }
}
