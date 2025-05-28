<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductSku;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductSku>
 */
class ProductSkuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'size_attribute_id' => null,
            'color_attribute_id' => null,
            'sku' => fake()->ean13(),
            'price' => fake()->numberBetween(100, 9999),
            'discount_price' => fake()->optional(0.5)->numberBetween(100, 9999),
            'quantity' => fake()->randomNumber(2),
        ];
    }

    /**
     * @param  mixed  $sizeAttributes
     * @param  mixed  $colorAttributes
     */
    public function withAttributes($sizeAttributes, $colorAttributes): static
    {
        return $this->state(fn (): array => [
            'size_attribute_id' => $sizeAttributes->random()->id,
            'color_attribute_id' => $colorAttributes->random()->id,
        ]);
    }

    public function withNewAttributes(): static
    {
        return $this->afterCreating(function ($variant): void {
            $sizeAttr = ProductAttribute::factory()->size()->create();
            $colorAttr = ProductAttribute::factory()->color()->create();

            $variant->update([
                'size_attribute_id' => $sizeAttr->id,
                'color_attribute_id' => $colorAttr->id,
            ]);
        });
    }
}
