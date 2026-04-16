<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_list_customers(): void
    {
        $admin = \App\Models\User::factory()->create();
        $customer = \App\Models\Customer::factory()->create();

        $response = $this->actingAs($admin, 'web')->get('/admin/customers');

        $response->assertStatus(200);
        $response->assertSee($customer->name);
    }

    public function test_admin_can_view_customer(): void
    {
        $admin = \App\Models\User::factory()->create();
        $customer = \App\Models\Customer::factory()->create();

        $response = $this->actingAs($admin, 'web')->get('/admin/customers/' . $customer->id);

        $response->assertStatus(200);
        $response->assertSee($customer->name);
    }

    public function test_admin_can_update_customer_status(): void
    {
        $admin = \App\Models\User::factory()->create();
        $customer = \App\Models\Customer::factory()->create(['is_active' => true]);

        $response = $this->actingAs($admin, 'web')->put('/admin/customers/' . $customer->id, [
            'is_active' => false,
        ]);

        $response->assertRedirect(route('admin.customers.show', $customer));
        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'is_active' => false,
        ]);
    }
}
