<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_list_orders(): void
    {
        $admin = \App\Models\User::factory()->create();
        $order = \App\Models\Order::factory()->create();

        $response = $this->actingAs($admin, 'web')->get('/admin/orders');

        $response->assertStatus(200);
        $response->assertSee($order->order_number);
    }

    public function test_admin_can_view_order(): void
    {
        $admin = \App\Models\User::factory()->create();
        $order = \App\Models\Order::factory()->create();

        $response = $this->actingAs($admin, 'web')->get('/admin/orders/' . $order->id);

        $response->assertStatus(200);
        $response->assertSee($order->order_number);
    }

    public function test_admin_can_update_order_status(): void
    {
        $admin = \App\Models\User::factory()->create();
        $order = \App\Models\Order::factory()->create([
            'order_status' => 'pending'
        ]);

        $response = $this->actingAs($admin, 'web')->put('/admin/orders/' . $order->id, [
            'order_status' => 'delivered',
        ]);

        $response->assertRedirect(route('admin.orders.show', $order));
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'order_status' => 'delivered',
        ]);
    }
}
