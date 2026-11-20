<?php

use App\Http\Controllers\Auth\LockScreenController;
use App\Http\Controllers\Auth\MobileVerificationController;
use Illuminate\Support\Facades\Route;

/*
 * Auth Routes
 *
 * Login, registration, password reset, email verification, two-factor
 * challenge and password confirmation are provided by Laravel Fortify
 * (views are configured in App\Providers\FortifyServiceProvider).
 * The routes below cover the additional LaraPlate auth screens.
 */

Route::middleware('auth')->group(function () {
    // Change password (form submits to Fortify's `user-password.update` route)
    Route::view('change-password', 'auth.change-password')
        ->name('password.change');

    // Lock screen
    Route::get('lock-screen', [LockScreenController::class, 'show'])
        ->name('lock-screen');
    Route::post('lock-screen', [LockScreenController::class, 'unlock'])
        ->middleware('throttle:5,1')
        ->name('lock-screen.unlock');

    // Mobile verification
    Route::get('verify-mobile', [MobileVerificationController::class, 'notice'])
        ->name('mobile.verify');
    Route::post('verify-mobile/send', [MobileVerificationController::class, 'send'])
        ->middleware('throttle:6,1')
        ->name('mobile.verify.send');
    Route::post('verify-mobile', [MobileVerificationController::class, 'verify'])
        ->middleware('throttle:6,1')
        ->name('mobile.verify.store');
});
