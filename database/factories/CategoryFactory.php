<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'label' => fake()->sentence(6),
        ];
    }

    public function withImage(): Factory|self
    {
        return $this->afterCreating(function (Category $category): void {
            $imageUrl = "https://ui-avatars.com/api/?name={$category->name}&background=687387&color=ffffff&bold=true&format=png";
            $category->update(['image_url' => $imageUrl]);
        });
    }
}
