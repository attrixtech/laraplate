<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LockScreenController extends Controller
{
    /**
     * The session key used to flag a locked screen.
     */
    public const SESSION_KEY = 'auth.locked';

    /**
     * Lock the current session and show the lock screen.
     */
    public function show(Request $request): View
    {
        $request->session()->put(self::SESSION_KEY, true);

        return view('auth.lock-screen', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Unlock the session after re-entering the account password.
     */
    public function unlock(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string', 'current_password:web'],
        ], [
            'password.current_password' => __('The provided password is incorrect.'),
        ]);

        $request->session()->forget(self::SESSION_KEY);
        $request->session()->passwordConfirmed();
        $request->session()->regenerate();

        return redirect()->intended(route('frontend.index'));
    }
}
