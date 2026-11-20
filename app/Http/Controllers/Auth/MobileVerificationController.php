<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MobileVerificationController extends Controller
{
    /**
     * Minutes a verification code stays valid.
     */
    private const CODE_TTL_MINUTES = 10;

    /**
     * Seconds a user must wait before requesting another code.
     */
    private const RESEND_DECAY_SECONDS = 60;

    /**
     * Show the mobile verification screen.
     */
    public function notice(Request $request): View|RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        if ($user->hasVerifiedMobile()) {
            return redirect()->intended(route('frontend.index'));
        }

        return view('auth.verify-mobile', ['user' => $user]);
    }

    /**
     * Generate and send a new verification code to the user's mobile number.
     */
    public function send(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        if ($user->hasVerifiedMobile()) {
            return redirect()->intended(route('frontend.index'));
        }

        if (blank($user->mobile)) {
            throw ValidationException::withMessages([
                'code' => __('Please add a mobile number to your account first.'),
            ]);
        }

        $throttleKey = 'verify-mobile-send:'.$user->id;

        if (RateLimiter::tooManyAttempts($throttleKey, 1)) {
            throw ValidationException::withMessages([
                'code' => __('Please wait :seconds seconds before requesting a new code.', [
                    'seconds' => RateLimiter::availableIn($throttleKey),
                ]),
            ]);
        }

        RateLimiter::hit($throttleKey, self::RESEND_DECAY_SECONDS);

        $code = (string) random_int(100000, 999999);

        Cache::put($this->cacheKey($user), Hash::make($code), now()->addMinutes(self::CODE_TTL_MINUTES));

        // TODO: Deliver the code through your SMS provider (e.g. a Notification with an SMS channel).
        if (! app()->isProduction()) {
            Log::info("Mobile verification code for user #{$user->id} ({$user->mobile}): {$code}");
        }

        return back()->with('status', 'verification-code-sent');
    }

    /**
     * Verify the submitted code and mark the mobile number as verified.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        /** @var User $user */
        $user = $request->user();
        $hash = Cache::get($this->cacheKey($user));

        if (! is_string($hash) || ! Hash::check($request->string('code')->toString(), $hash)) {
            throw ValidationException::withMessages([
                'code' => __('The provided code is invalid or has expired.'),
            ]);
        }

        Cache::forget($this->cacheKey($user));
        $user->markMobileAsVerified();

        return redirect()->intended(route('frontend.index'))->with('status', 'mobile-verified');
    }

    /**
     * Cache key holding the hashed verification code for the user.
     */
    private function cacheKey(User $user): string
    {
        return "mobile-verification:{$user->id}:".sha1((string) $user->mobile);
    }
}
