<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_view_change_password_screen(): void
    {
        $this->get(route('password.change'))->assertRedirect(route('login'));
    }

    public function test_password_can_be_changed(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('password.change'))
            ->put(route('user-password.update'), [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('password.change'))
            ->assertSessionHas('status', 'password-updated');

        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    public function test_current_password_must_be_correct(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('password.change'))
            ->put(route('user-password.update'), [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->assertSessionHasErrorsIn('updatePassword', 'current_password');

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
