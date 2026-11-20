<?php

namespace Tests\Feature\Backend;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_renders_with_user_stats(): void
    {
        $admin = User::factory()->create([
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'email' => 'ada@example.com',
        ]);

        User::factory()->unverified()->create();

        $this->actingAs($admin)
            ->get(route('admin.admin'))
            ->assertOk()
            ->assertSee('Welcome back, Ada')
            ->assertSee('Recent Users')
            ->assertSee('ada@example.com')
            ->assertSee('System Status');
    }

    public function test_admin_dashboard_renders_without_authenticated_user(): void
    {
        $this->get(route('admin.admin'))
            ->assertOk()
            ->assertSee('Dashboard')
            ->assertSee('No users have registered yet.');
    }
}
