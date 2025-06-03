<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\AddressType;
use App\Models\Country;
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
            'type' => AddressType::randomValue(),
            'address_one' => fake()->streetAddress(),
            'address_two' => fake()->boolean(70) ? fake()->streetAddress() : null,
            'country_code' => Country::inRandomOrder()->value('code') ?? 'US',
            'city' => fake()->city(),
            'state' => fake()->randomElement(['California', 'New York', 'Texas', 'Florida', 'Illinois']),
            'zip_code' => fake()->postcode(),
        ];
    }
}
