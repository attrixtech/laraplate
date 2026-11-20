@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@php
    $verifiedRate = $stats['totalUsers'] > 0
        ? (int) round(($stats['verifiedUsers'] / $stats['totalUsers']) * 100)
        : 0;

    $twoFactorRate = $stats['totalUsers'] > 0
        ? (int) round(($stats['twoFactorUsers'] / $stats['totalUsers']) * 100)
        : 0;

    $cards = [
        [
            'label' => __('Total Users'),
            'value' => number_format($stats['totalUsers']),
            'meta' => __('Registered accounts'),
            'icon' => 'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z',
        ],
        [
            'label' => __('Verified Emails'),
            'value' => number_format($stats['verifiedUsers']),
            'meta' => __(':rate% verification rate', ['rate' => $verifiedRate]),
            'accent' => 'emerald',
            'icon' => 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
        ],
        [
            'label' => __('New This Month'),
            'value' => number_format($stats['newUsersThisMonth']),
            'meta' => now()->format('F Y'),
            'icon' => 'M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941',
        ],
        [
            'label' => __('2FA Enabled'),
            'value' => number_format($stats['twoFactorUsers']),
            'meta' => __(':rate% of accounts', ['rate' => $twoFactorRate]),
            'icon' => 'M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z',
        ],
    ];

    $systemInfo = [
        ['label' => __('Environment'), 'value' => app()->environment()],
        ['label' => __('Laravel'), 'value' => 'v' . app()->version()],
        ['label' => __('PHP'), 'value' => PHP_VERSION],
        ['label' => __('Database'), 'value' => config('database.default')],
        ['label' => __('Cache Driver'), 'value' => config('cache.default')],
        ['label' => __('Queue Driver'), 'value' => config('queue.default')],
    ];
@endphp

@section('content')
    {{-- Page header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                @auth
                    {{ __('Welcome back, :name', ['name' => auth()->user()->first_name]) }}
                @else
                    {{ __('Dashboard') }}
                @endauth
            </h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                {{ __('Here is what is happening across :app today.', ['app' => config('app.name', 'LaraPlate')]) }}
            </p>
        </div>

        <div class="flex items-center gap-2.5">
            <a href="{{ route('frontend.index') }}"
               class="inline-flex items-center gap-2 rounded-lg border border-zinc-200 bg-white px-3.5 py-2 text-sm font-medium text-zinc-700 shadow-2xs transition hover:bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800">
                {{ __('View site') }}
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-zinc-900 px-3.5 py-2 text-sm font-medium text-white shadow-2xs transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ __('New user') }}
                </a>
            @endif
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($cards as $card)
            <div class="rounded-xl border border-zinc-200 bg-white p-5 shadow-2xs transition hover:border-zinc-300 dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ $card['label'] }}</p>
                    <span class="grid size-9 place-items-center rounded-lg bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" />
                        </svg>
                    </span>
                </div>
                <p class="mt-3 text-3xl font-semibold tracking-tight text-zinc-900 tabular-nums dark:text-white">
                    {{ $card['value'] }}
                </p>
                <p class="mt-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                    @if (($card['accent'] ?? null) === 'emerald')
                        <span class="inline-flex items-center gap-1 font-medium text-emerald-600 dark:text-emerald-400">
                            <span class="size-1.5 rounded-full bg-emerald-500"></span>
                            {{ $card['meta'] }}
                        </span>
                    @else
                        {{ $card['meta'] }}
                    @endif
                </p>
            </div>
        @endforeach
    </div>

    {{-- Main content grid --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        {{-- Recent users table --}}
        <section id="users" class="overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-2xs dark:border-zinc-800 dark:bg-zinc-900 lg:col-span-2">
            <div class="flex items-center justify-between border-b border-zinc-200 px-5 py-4 dark:border-zinc-800">
                <div>
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-white">{{ __('Recent Users') }}</h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('Latest accounts registered in the application.') }}</p>
                </div>
                <span class="rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600 tabular-nums dark:bg-zinc-800 dark:text-zinc-300">
                    {{ trans_choice(':count user|:count users', $stats['totalUsers'], ['count' => $stats['totalUsers']]) }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-zinc-200 bg-zinc-50/70 text-xs font-medium uppercase tracking-wider text-zinc-500 dark:border-zinc-800 dark:bg-zinc-950/40 dark:text-zinc-400">
                        <tr>
                            <th scope="col" class="px-5 py-3">{{ __('User') }}</th>
                            <th scope="col" class="px-5 py-3">{{ __('Mobile') }}</th>
                            <th scope="col" class="px-5 py-3">{{ __('Status') }}</th>
                            <th scope="col" class="px-5 py-3 text-right">{{ __('Joined') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200/80 dark:divide-zinc-800/80">
                        @forelse ($recentUsers as $recentUser)
                            <tr class="transition-colors hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40">
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <span class="grid size-8 shrink-0 place-items-center rounded-full bg-zinc-900 text-xs font-semibold text-white dark:bg-zinc-100 dark:text-zinc-900">
                                            {{ $recentUser->initials() }}
                                        </span>
                                        <div class="min-w-0">
                                            <p class="truncate font-medium text-zinc-900 dark:text-white">{{ $recentUser->name }}</p>
                                            <p class="truncate text-xs text-zinc-500 dark:text-zinc-400">{{ $recentUser->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5 text-zinc-600 tabular-nums dark:text-zinc-400">
                                    {{ $recentUser->mobile ?: '—' }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    @if ($recentUser->hasVerifiedEmail())
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400">
                                            <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                            {{ __('Verified') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 dark:bg-amber-950/60 dark:text-amber-400">
                                            <span class="size-1.5 rounded-full bg-amber-500"></span>
                                            {{ __('Pending') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5 text-right text-xs text-zinc-500 tabular-nums dark:text-zinc-400">
                                    {{ $recentUser->created_at?->diffForHumans() ?? '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-10 text-center text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ __('No users have registered yet.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Right column: Quick links & System info --}}
        <div class="space-y-6">
            {{-- Quick actions --}}
            <section class="rounded-xl border border-zinc-200 bg-white p-5 shadow-2xs dark:border-zinc-800 dark:bg-zinc-900">
                <h2 class="text-base font-semibold text-zinc-900 dark:text-white">{{ __('Quick Actions') }}</h2>
                <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">{{ __('Common administrative shortcuts.') }}</p>

                <div class="mt-4 space-y-2">
                    @auth
                        <a href="{{ route('password.change') }}"
                           class="flex items-center justify-between rounded-lg border border-zinc-200 px-3.5 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-800/80">
                            <span>{{ __('Change password') }}</span>
                            <span aria-hidden="true" class="text-zinc-400">&rarr;</span>
                        </a>
                        <a href="{{ route('lock-screen') }}"
                           class="flex items-center justify-between rounded-lg border border-zinc-200 px-3.5 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-800/80">
                            <span>{{ __('Lock screen') }}</span>
                            <span aria-hidden="true" class="text-zinc-400">&rarr;</span>
                        </a>
                    @endauth

                    @if (Route::has('telescope'))
                        <a href="{{ route('telescope') }}" target="_blank" rel="noopener noreferrer"
                           class="flex items-center justify-between rounded-lg border border-zinc-200 px-3.5 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-800/80">
                            <span>{{ __('Open Telescope') }}</span>
                            <span aria-hidden="true" class="text-zinc-400">&nearr;</span>
                        </a>
                    @endif
                </div>
            </section>

            {{-- System overview --}}
            <section class="rounded-xl border border-zinc-200 bg-white p-5 shadow-2xs dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-white">{{ __('System Status') }}</h2>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400">
                        <span class="size-1.5 rounded-full bg-emerald-500"></span>
                        {{ __('Healthy') }}
                    </span>
                </div>

                <dl class="mt-4 divide-y divide-zinc-100 text-sm dark:divide-zinc-800">
                    @foreach ($systemInfo as $row)
                        <div class="flex items-center justify-between py-2.5 first:pt-0 last:pb-0">
                            <dt class="text-zinc-500 dark:text-zinc-400">{{ $row['label'] }}</dt>
                            <dd class="font-mono text-xs font-medium text-zinc-900 dark:text-zinc-100">{{ $row['value'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </section>
        </div>
    </div>
@endsection
