<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CustomerAddress;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CustomerAddress>
 */
class CustomerAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => 'home',
            'address_one' => fake()->streetAddress(),
            'address_two' => fake()->boolean(70) ? fake()->streetAddress() : null,
            'country_code' => fake()->countryCode(),
            'city' => fake()->city(),
            'state' => fake()->randomElement(['California', 'New York', 'Texas', 'Florida', 'Illinois']),
            'zip_code' => fake()->postcode(),
        ];
    }
}
