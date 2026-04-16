<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 50, 500);
        $discount = fake()->randomFloat(2, 0, 10);
        $shipping = 10;
        $tax = ($subtotal - $discount) * 0.06;
        return [
            'customer_id' => \App\Models\Customer::factory(),
            'order_number' => 'ORD-' . strtoupper(fake()->unique()->lexify('??????')),
            'order_status' => 'pending',
            'subtotal_amount' => $subtotal,
            'discount_amount' => $discount,
            'shipping_amount' => $shipping,
            'tax_amount' => $tax,
            'total_amount' => $subtotal - $discount + $shipping + $tax,
            'currency' => 'MYR',
        ];
    }
}
