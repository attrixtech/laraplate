<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\LockScreenController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Redirect authenticated users with a locked session to the lock screen.
 */
class EnsureScreenIsUnlocked
{
    /**
     * Routes that remain reachable while the screen is locked.
     *
     * @var array<int, string>
     */
    protected array $except = [
        'lock-screen',
        'lock-screen.*',
        'logout',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->user()
            && $request->hasSession()
            && $request->session()->get(LockScreenController::SESSION_KEY)
            && ! $request->routeIs(...$this->except)
        ) {
            if ($request->expectsJson()) {
                abort(423, __('Your session is locked.'));
            }

            return redirect()->guest(route('lock-screen'));
        }

        return $next($request);
    }
}
