<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_login_page(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Admin'); // Assuming the word Admin appears on the admin login page
    }

    public function test_admin_can_login_with_correct_credentials(): void
    {
        $admin = \App\Models\User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin, 'web');
    }

    public function test_admin_cannot_login_with_incorrect_credentials(): void
    {
        $admin = \App\Models\User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest('web');
    }

    public function test_admin_can_logout(): void
    {
        $admin = \App\Models\User::factory()->create();

        $response = $this->actingAs($admin, 'web')->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest('web');
    }
}
