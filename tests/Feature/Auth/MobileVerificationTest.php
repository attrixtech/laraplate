<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class MobileVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_verified_users_are_redirected_away(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('mobile.verify'))
            ->assertRedirect(route('frontend.index'));
    }

    public function test_code_can_be_sent_and_verified(): void
    {
        $user = User::factory()->unverifiedMobile()->create();
        $code = null;

        Log::listen(function ($message) use (&$code) {
            if (preg_match('/: (\d{6})$/', $message->message, $matches)) {
                $code = $matches[1];
            }
        });

        $this->actingAs($user)
            ->from(route('mobile.verify'))
            ->post(route('mobile.verify.send'))
            ->assertSessionHas('status', 'verification-code-sent');

        $this->assertNotNull($code);

        $this->post(route('mobile.verify.store'), ['code' => $code])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('frontend.index'));

        $this->assertTrue($user->fresh()->hasVerifiedMobile());
    }

    public function test_invalid_code_is_rejected(): void
    {
        $user = User::factory()->unverifiedMobile()->create();

        $this->actingAs($user)->post(route('mobile.verify.send'));

        $this->post(route('mobile.verify.store'), ['code' => '000000'])
            ->assertSessionHasErrors('code');

        $this->assertFalse($user->fresh()->hasVerifiedMobile());
    }

    public function test_resending_is_throttled(): void
    {
        $user = User::factory()->unverifiedMobile()->create();

        $this->actingAs($user)->post(route('mobile.verify.send'))->assertSessionHasNoErrors();
        $this->post(route('mobile.verify.send'))->assertSessionHasErrors('code');
    }

    public function test_users_without_mobile_cannot_request_code(): void
    {
        $user = User::factory()->withoutMobile()->create();

        $this->actingAs($user)
            ->post(route('mobile.verify.send'))
            ->assertSessionHasErrors('code');
    }
}
