<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NewUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('testing'), // password
            'user_type_id' => $this->faker->numberBetween(1, 3), // Adjust the range based on your 'user_type' table
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
