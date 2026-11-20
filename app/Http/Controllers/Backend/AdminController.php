<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::query()->count();
        $verifiedUsers = User::query()->whereNotNull('email_verified_at')->count();
        $newUsersThisMonth = User::query()->where('created_at', '>=', now()->startOfMonth())->count();
        $twoFactorUsers = User::query()->whereNotNull('two_factor_confirmed_at')->count();

        $recentUsers = User::query()
            ->latest()
            ->limit(6)
            ->get();

        return view('backend.dashboard', [
            'stats' => [
                'totalUsers' => $totalUsers,
                'verifiedUsers' => $verifiedUsers,
                'newUsersThisMonth' => $newUsersThisMonth,
                'twoFactorUsers' => $twoFactorUsers,
            ],
            'recentUsers' => $recentUsers,
        ]);
    }
}
