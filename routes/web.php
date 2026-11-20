<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
// Route::get('/lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

// Redirect user after login
Route::get('redirect', [HomeController::class, 'redirect'])
    ->name('redirect');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.',
    // 'middleware' => ['admin']
], function () {
    includeRouteFiles(__DIR__.'/backend/');
});

require __DIR__.'/auth.php';
require __DIR__.'/settings.php';
