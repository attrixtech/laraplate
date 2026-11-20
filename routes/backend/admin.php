<?php

use App\Http\Controllers\Backend\AdminController;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

Route::get('/', [AdminController::class, 'index'])
    ->name('admin')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push('Administration', route('admin.admin'));
    });
