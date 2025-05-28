<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductAttribute>
 */
class ProductAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['color', 'size']);

        return [
            'type' => $type,
            'value' => $type === 'color'
                ? fake()->safeColorName()
                : fake()->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL']),
        ];
    }

    public function color(): static
    {
        return $this->state(fn (): array => [
            'type' => 'color',
            'value' => fake()->safeColorName(),
        ]);
    }

    public function size(): static
    {
        return $this->state(fn (): array => [
            'type' => 'size',
            'value' => fake()->randomElement(['XS', 'S', 'M', 'L', 'XL']),
        ]);
    }
}
