<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthViewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_auth_screens_render(): void
    {
        $this->get(route('login'))->assertOk()->assertSee('Welcome back');
        $this->get(route('register'))->assertOk()->assertSee('first_name', false)->assertSee('mobile', false);
        $this->get(route('password.request'))->assertOk()->assertSee('Forgot your password?');
        $this->get(route('password.reset', ['token' => 'test-token', 'email' => 'jane@example.com']))
            ->assertOk()
            ->assertSee('test-token')
            ->assertSee('jane@example.com');
    }

    public function test_authenticated_auth_screens_render(): void
    {
        $user = User::factory()->unverified()->unverifiedMobile()->create();

        $this->actingAs($user);

        $this->get(route('verification.notice'))->assertOk()->assertSee($user->email);
        $this->get(route('password.confirm'))->assertOk()->assertSee('Confirm your password');
        $this->get(route('password.change'))->assertOk()->assertSee('Change your password');
        $this->get(route('mobile.verify'))->assertOk()->assertSee('Verify your mobile number');
        $this->get(route('lock-screen'))->assertOk()->assertSee($user->name);
    }

    public function test_user_name_is_built_from_first_and_last_name(): void
    {
        $user = User::factory()->make(['first_name' => 'Jane', 'last_name' => 'Doe']);

        $this->assertSame('Jane Doe', $user->name);
        $this->assertSame('JD', $user->initials());
    }
}
