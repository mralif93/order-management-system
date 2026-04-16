<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SellerProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_seller_can_list_own_products(): void
    {
        $seller = \App\Models\Seller::factory()->create();
        $otherSeller = \App\Models\Seller::factory()->create();

        $product1 = \App\Models\Product::factory()->create(['seller_id' => $seller->id, 'name' => 'My Product']);
        $product2 = \App\Models\Product::factory()->create(['seller_id' => $otherSeller->id, 'name' => 'Other Product']);

        $response = $this->actingAs($seller, 'seller')->get(url('seller/products'));

        $response->assertStatus(200);
        $response->assertSee('My Product');
        $response->assertDontSee('Other Product');
    }

    public function test_seller_can_create_product(): void
    {
        $seller = \App\Models\Seller::factory()->create();

        $response = $this->actingAs($seller, 'seller')->post(url('seller/products'), [
            'name' => 'New Awesome Product',
            'sku' => 'AWESOME-001',
            'price' => 10.99,
            'quantity' => 50,
            'currency' => 'MYR',
        ]);

        $response->assertRedirect(url('seller/products'));
        $this->assertDatabaseHas('products', [
            'seller_id' => $seller->id,
            'name' => 'New Awesome Product',
            'sku' => 'AWESOME-001',
        ]);
    }

    public function test_seller_can_update_own_product(): void
    {
        $seller = \App\Models\Seller::factory()->create();
        $product = \App\Models\Product::factory()->create(['seller_id' => $seller->id, 'name' => 'Old Name']);

        $response = $this->actingAs($seller, 'seller')->put(url('seller/products/' . $product->id), [
            'name' => 'Updated Name',
            'sku' => $product->sku,
            'price' => 20.00,
            'quantity' => 10,
            'currency' => 'MYR',
        ]);

        $response->assertRedirect(url('seller/products'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_seller_cannot_update_other_sellers_product(): void
    {
        $seller = \App\Models\Seller::factory()->create();
        $otherSeller = \App\Models\Seller::factory()->create();
        $product = \App\Models\Product::factory()->create(['seller_id' => $otherSeller->id, 'name' => 'Other Name']);

        $response = $this->actingAs($seller, 'seller')->put(url('seller/products/' . $product->id), [
            'name' => 'Updated Name',
            'sku' => 'NEW-SKU-999',
            'price' => 20.00,
            'quantity' => 10,
            'currency' => 'MYR',
        ]);

        $response->assertStatus(403); // Or 403 depending on implementation
    }

    public function test_seller_can_delete_own_product(): void
    {
        $seller = \App\Models\Seller::factory()->create();
        $product = \App\Models\Product::factory()->create(['seller_id' => $seller->id]);

        $response = $this->actingAs($seller, 'seller')->delete(url('seller/products/' . $product->id));

        $response->assertRedirect(url('seller/products'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
