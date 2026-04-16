<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_list_products(): void
    {
        $admin = \App\Models\User::factory()->create();
        $product = \App\Models\Product::factory()->create();

        $response = $this->actingAs($admin, 'web')->get('/admin/products');

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_admin_can_create_product(): void
    {
        $admin = \App\Models\User::factory()->create();

        $response = $this->actingAs($admin, 'web')->post('/admin/products', [
            'name' => 'Admin Product',
            'sku' => 'ADM-001',
            'price' => 15.00,
            'currency' => 'MYR',
            'quantity' => 100,
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'sku' => 'ADM-001',
            'name' => 'Admin Product'
        ]);
    }

    public function test_admin_can_update_product(): void
    {
        $admin = \App\Models\User::factory()->create();
        $product = \App\Models\Product::factory()->create();

        $response = $this->actingAs($admin, 'web')->put('/admin/products/' . $product->id, [
            'name' => 'Updated Admin Product',
            'sku' => $product->sku,
            'price' => 25.00,
            'currency' => 'MYR',
            'quantity' => 200,
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Admin Product'
        ]);
    }

    public function test_admin_can_delete_product(): void
    {
        $admin = \App\Models\User::factory()->create();
        $product = \App\Models\Product::factory()->create();

        $response = $this->actingAs($admin, 'web')->delete('/admin/products/' . $product->id);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
