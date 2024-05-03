<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
            'city' => $this->faker->city(),
            'neighborhood' => $this->faker->citySuffix(),
            'address_line' => $this->faker->streetName(),
            'address_line2' => $this->faker->secondaryAddress(),
            'number' => $this->faker->buildingNumber(),
            'state' => "MG",
            'zip_code' => $this->faker->postcode(),
            'user' => 1,

        ];
    }
}
