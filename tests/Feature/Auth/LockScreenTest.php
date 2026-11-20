<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LockScreenTest extends TestCase
{
    use RefreshDatabase;

    public function test_visiting_lock_screen_locks_the_session(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('lock-screen'))
            ->assertOk()
            ->assertSessionHas('auth.locked', true);
    }

    public function test_locked_users_are_redirected_to_lock_screen(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['auth.locked' => true])
            ->get(route('password.change'))
            ->assertRedirect(route('lock-screen'));
    }

    public function test_screen_can_be_unlocked_with_correct_password(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['auth.locked' => true, 'url.intended' => route('password.change')])
            ->post(route('lock-screen.unlock'), ['password' => 'password'])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('password.change'))
            ->assertSessionMissing('auth.locked');
    }

    public function test_screen_stays_locked_with_wrong_password(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['auth.locked' => true])
            ->post(route('lock-screen.unlock'), ['password' => 'wrong-password'])
            ->assertSessionHasErrors('password')
            ->assertSessionHas('auth.locked', true);
    }

    public function test_locked_users_can_log_out(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['auth.locked' => true])
            ->post(route('logout'))
            ->assertRedirect('/');

        $this->assertGuest();
    }
}
