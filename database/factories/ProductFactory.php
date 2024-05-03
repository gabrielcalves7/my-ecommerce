<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            //
            'name' => $this->faker->colorName(),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'category' => ProductCategory::query()->get('id')->random(),
            'description' => $this->faker->paragraph('1'),
            'SKU' => $this->faker->randomNumber(6),
            'image' => $this->faker->imageUrl(640, 480, 'animals', true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
