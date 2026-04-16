<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SellerOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_seller_can_list_own_orders(): void
    {
        $seller = \App\Models\Seller::factory()->create();
        $product = \App\Models\Product::factory()->create(['seller_id' => $seller->id]);
        $order = \App\Models\Order::factory()->create();
        \App\Models\OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAs($seller, 'seller')->get(url('seller/orders'));
        $response->assertStatus(200);
        $response->assertSee($order->order_number);
    }

    public function test_seller_cannot_see_other_seller_orders(): void
    {
        $seller = \App\Models\Seller::factory()->create();
        $otherSeller = \App\Models\Seller::factory()->create();

        $product = \App\Models\Product::factory()->create(['seller_id' => $otherSeller->id]);
        $order = \App\Models\Order::factory()->create();
        \App\Models\OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAs($seller, 'seller')->get(url('seller/orders/' . $order->id));
        $response->assertStatus(403);
    }

    public function test_seller_can_update_own_order_status(): void
    {
        $seller = \App\Models\Seller::factory()->create();
        $product = \App\Models\Product::factory()->create(['seller_id' => $seller->id]);
        $order = \App\Models\Order::factory()->create(['order_status' => 'pending']);
        \App\Models\OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAs($seller, 'seller')->put(url('seller/orders/' . $order->id), [
            'order_status' => 'processing',
        ]);

        $response->assertRedirect(route('seller.orders.index'));
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'order_status' => 'processing',
        ]);
    }

    public function test_seller_can_delete_own_order(): void
    {
        $seller = \App\Models\Seller::factory()->create();
        $product = \App\Models\Product::factory()->create(['seller_id' => $seller->id]);
        $order = \App\Models\Order::factory()->create();
        \App\Models\OrderItem::factory()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
        ]);

        $response = $this->actingAs($seller, 'seller')->delete(url('seller/orders/' . $order->id));

        $response->assertRedirect();
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}
