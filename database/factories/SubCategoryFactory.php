<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SubCategory>
 */
class SubCategoryFactory extends Factory
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
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => str($name)->slug(),
            'label' => fake()->sentence(6),
        ];
    }

    public function withImage(): Factory|self
    {
        return $this->afterCreating(function (SubCategory $subCategory): void {
            $imageUrl = "https://ui-avatars.com/api/?name={$subCategory->name}&background=687387&color=ffffff&bold=true&format=png";
            $subCategory->update(['image_url' => $imageUrl]);
        });
    }
}
