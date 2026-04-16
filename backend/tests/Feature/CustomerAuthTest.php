<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/customer/dashboard');
        $this->assertDatabaseHas('customers', [
            'email' => 'johndoe@example.com',
        ]);
        $this->assertAuthenticatedAs(\App\Models\Customer::first(), 'customer');
    }

    public function test_customer_can_login(): void
    {
        $customer = \App\Models\Customer::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $customer->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/customer/dashboard');
        $this->assertAuthenticatedAs($customer, 'customer');
    }

    public function test_customer_can_logout(): void
    {
        $customer = \App\Models\Customer::factory()->create();

        $response = $this->actingAs($customer, 'customer')->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest('customer');
    }

    public function test_unauthenticated_customer_cannot_access_dashboard(): void
    {
        $response = $this->get('/customer/dashboard');

        $response->assertRedirect('/login');
    }
}
