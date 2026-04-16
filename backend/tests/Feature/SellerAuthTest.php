<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SellerAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_seller_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('seller.login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
        $response->assertSee('Seller Login');
    }

    public function test_seller_can_authenticate_using_the_login_screen(): void
    {
        $seller = \App\Models\Seller::factory()->create([
            'email' => 'seller@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'is_active' => true,
        ]);

        $response = $this->post(url('seller/login'), [
            'email' => 'seller@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($seller, 'seller');
        $response->assertRedirect(route('seller.dashboard'));
    }

    public function test_seller_can_not_authenticate_with_invalid_password(): void
    {
        $seller = \App\Models\Seller::factory()->create([
            'email' => 'seller@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'is_active' => true,
        ]);

        $response = $this->post(url('seller/login'), [
            'email' => 'seller@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest('seller');
    }

    public function test_seller_can_logout(): void
    {
        $seller = \App\Models\Seller::factory()->create();

        $response = $this->actingAs($seller, 'seller')->post(route('logout'));

        $this->assertGuest('seller');
        $response->assertRedirect('/');
    }
}
