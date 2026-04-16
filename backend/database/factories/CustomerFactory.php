<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address_line1' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => 'Selangor',
            'postal_code' => fake()->postcode(),
            'country' => 'MY',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'is_active' => true,
            'is_locked' => false,
        ];
    }
}
