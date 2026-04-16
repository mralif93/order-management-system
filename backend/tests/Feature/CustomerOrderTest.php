<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_view_own_orders(): void
    {
        $customer = \App\Models\Customer::factory()->create();
        $otherCustomer = \App\Models\Customer::factory()->create();

        $seller = \App\Models\Seller::factory()->create();
        $product = \App\Models\Product::factory()->create(['seller_id' => $seller->id]);

        $order1 = \App\Models\Order::factory()->create(['customer_id' => $customer->id]);
        \App\Models\OrderItem::factory()->create([
            'order_id' => $order1->id,
            'product_id' => $product->id,
        ]);

        $order2 = \App\Models\Order::factory()->create(['customer_id' => $otherCustomer->id]);
        \App\Models\OrderItem::factory()->create([
            'order_id' => $order2->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAs($customer, 'customer')->get('/customer/orders');

        $response->assertStatus(200);
        $response->assertSee($order1->order_number);
        $response->assertDontSee($order2->order_number);
    }

    public function test_customer_can_view_own_order_details(): void
    {
        $customer = \App\Models\Customer::factory()->create();
        $seller = \App\Models\Seller::factory()->create();
        $order = \App\Models\Order::factory()->create(['customer_id' => $customer->id]);
        $product = \App\Models\Product::factory()->create(['seller_id' => $seller->id]);
        \App\Models\OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAs($customer, 'customer')->get('/customer/orders/' . $order->id);

        $response->assertStatus(200);
        $response->assertSee($order->order_number);
        $response->assertSee($product->name);
    }

    public function test_customer_can_browse_catalog(): void
    {
        $customer = \App\Models\Customer::factory()->create();
        $seller = \App\Models\Seller::factory()->create();
        $product = \App\Models\Product::factory()->create(['seller_id' => $seller->id, 'is_active' => true]);

        $response = $this->actingAs($customer, 'customer')->get('/customer/catalog');

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_customer_cannot_view_others_order_details(): void
    {
        $customer = \App\Models\Customer::factory()->create();
        $otherCustomer = \App\Models\Customer::factory()->create();
        $seller = \App\Models\Seller::factory()->create();
        $product = \App\Models\Product::factory()->create(['seller_id' => $seller->id]);
        $order = \App\Models\Order::factory()->create(['customer_id' => $otherCustomer->id]);
        \App\Models\OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAs($customer, 'customer')->get('/customer/orders/' . $order->id);

        $response->assertStatus(403);
    }


}
