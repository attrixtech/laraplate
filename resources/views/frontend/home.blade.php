@extends('frontend.layouts.app')

@section('title', __('Home'))

@php
    $features = [
        ['title' => __('Frontend / Backend Split'), 'description' => __('Routes, controllers, views and assets are organised into separate frontend and backend directories from day one.'), 'icon' => 'M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z'],
        ['title' => __('Authentication'), 'description' => __('Login, registration, email verification, password reset, two-factor auth and passkeys powered by Laravel Fortify.'), 'icon' => 'M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z'],
        ['title' => __('Roles & Permissions'), 'description' => __('Fine-grained access control out of the box with spatie/laravel-permission and a protected admin area.'), 'icon' => 'M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z'],
        ['title' => __('Social Login'), 'description' => __('Let users sign in with their favourite providers via Laravel Socialite, ready to configure.'), 'icon' => 'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z'],
        ['title' => __('Media Library'), 'description' => __('Associate files and images with any Eloquent model using spatie/laravel-medialibrary.'), 'icon' => 'm2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z'],
        ['title' => __('Developer Tooling'), 'description' => __('Telescope, Pint, Larastan and PHPUnit configured so you can ship clean, tested code with confidence.'), 'icon' => 'M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5'],
    ];

    $stack = ['Laravel 13', 'Livewire 4', 'Flux UI', 'Tailwind CSS 4', 'Fortify', 'Socialite', 'Spatie Permission', 'Media Library', 'Telescope', 'Vite'];

    $steps = [
        ['command' => 'git clone <repo-url> my-app && cd my-app', 'label' => __('Clone the repository')],
        ['command' => 'composer setup', 'label' => __('Install dependencies, generate key & migrate')],
        ['command' => 'composer dev', 'label' => __('Start the development servers')],
    ];
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative isolate overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top,var(--color-zinc-100),transparent_60%)] dark:bg-[radial-gradient(ellipse_at_top,var(--color-zinc-900),transparent_60%)]"></div>
        <div class="mx-auto max-w-7xl px-4 py-24 text-center sm:px-6 sm:py-32 lg:px-8">
            <span class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white px-3 py-1 text-xs font-medium text-zinc-600 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-400">
                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                {{ __('Built on Laravel :version', ['version' => app()->version()]) }}
            </span>

            <h1 class="mx-auto mt-6 max-w-3xl text-4xl font-semibold tracking-tight text-zinc-900 sm:text-6xl dark:text-white">
                {{ __('Start your next Laravel project in minutes') }}
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-zinc-600 dark:text-zinc-400">
                {{ __(':app is a ready-to-use boilerplate with authentication, roles, an admin area and a clean frontend / backend structure — so you can focus on building features.', ['app' => config('app.name', 'LaraPlate')]) }}
            </p>

            <div class="mt-10 flex flex-col items-center justify-center gap-3 sm:flex-row">
                @guest
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full rounded-md bg-zinc-900 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-zinc-700 sm:w-auto dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                            {{ __('Create an account') }}
                        </a>
                    @endif
                @endguest
                <a href="#features" class="w-full rounded-md border border-zinc-300 px-6 py-3 text-sm font-semibold text-zinc-900 transition hover:bg-zinc-50 sm:w-auto dark:border-zinc-700 dark:text-white dark:hover:bg-zinc-900">
                    {{ __('Explore features') }} &darr;
                </a>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section id="features" class="scroll-mt-16 border-t border-zinc-200 py-24 dark:border-zinc-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">{{ __('Features') }}</h2>
                <p class="mt-2 text-3xl font-semibold tracking-tight text-zinc-900 sm:text-4xl dark:text-white">
                    {{ __('Everything you need to get going') }}
                </p>
                <p class="mt-4 text-zinc-600 dark:text-zinc-400">
                    {{ __('Skip the repetitive setup. The essentials are already wired up and waiting for you.') }}
                </p>
            </div>

            <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($features as $feature)
                    <div class="group rounded-xl border border-zinc-200 bg-white p-6 transition hover:-translate-y-0.5 hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900 dark:hover:shadow-zinc-950">
                        <div class="grid size-10 place-items-center rounded-lg bg-zinc-100 text-zinc-900 transition group-hover:bg-zinc-900 group-hover:text-white dark:bg-zinc-800 dark:text-white dark:group-hover:bg-white dark:group-hover:text-zinc-900">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-base font-semibold text-zinc-900 dark:text-white">{{ $feature['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Stack --}}
    <section id="stack" class="scroll-mt-16 bg-zinc-50 py-24 dark:bg-zinc-900/40">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">{{ __('The Stack') }}</h2>
            <p class="mt-2 text-3xl font-semibold tracking-tight text-zinc-900 sm:text-4xl dark:text-white">
                {{ __('Powered by tools you already love') }}
            </p>
            <ul class="mx-auto mt-12 flex max-w-4xl flex-wrap justify-center gap-3">
                @foreach ($stack as $tool)
                    <li class="rounded-full border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">
                        {{ $tool }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Get started --}}
    <section id="get-started" class="scroll-mt-16 py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">{{ __('Get Started') }}</h2>
                <p class="mt-2 text-3xl font-semibold tracking-tight text-zinc-900 sm:text-4xl dark:text-white">
                    {{ __('Up and running in three commands') }}
                </p>
                <p class="mt-4 text-zinc-600 dark:text-zinc-400">
                    {{ __('Clone, set up and start developing. Your frontend lives in the frontend directories and your admin panel in backend — no guesswork.') }}
                </p>
            </div>

            <div class="overflow-hidden rounded-xl border border-zinc-800 bg-zinc-950 shadow-2xl">
                <div class="flex items-center gap-1.5 border-b border-zinc-800 px-4 py-3">
                    <span class="size-3 rounded-full bg-red-500/80"></span>
                    <span class="size-3 rounded-full bg-yellow-500/80"></span>
                    <span class="size-3 rounded-full bg-green-500/80"></span>
                </div>
                <ol class="space-y-4 p-6 font-mono text-sm">
                    @foreach ($steps as $step)
                        <li>
                            <p class="text-zinc-500"># {{ $loop->iteration }}. {{ $step['label'] }}</p>
                            <div class="mt-1 flex items-center justify-between gap-4">
                                <code class="text-zinc-100"><span class="text-emerald-400">$</span> {{ $step['command'] }}</code>
                                <button type="button" data-copy="{{ $step['command'] }}"
                                        class="shrink-0 rounded px-2 py-1 text-xs text-zinc-400 transition hover:bg-zinc-800 hover:text-white">
                                    {{ __('Copy') }}
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="px-4 pb-24 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl rounded-2xl bg-zinc-900 px-6 py-16 text-center dark:bg-white">
            <h2 class="text-3xl font-semibold tracking-tight text-white dark:text-zinc-900">
                {{ __('Ready to build something great?') }}
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-zinc-300 dark:text-zinc-600">
                {{ __('Stop rebuilding the same foundation for every project. Start with :app today.', ['app' => config('app.name', 'LaraPlate')]) }}
            </p>
            <div class="mt-8 flex justify-center gap-3">
                @guest
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-md bg-white px-6 py-3 text-sm font-semibold text-zinc-900 transition hover:bg-zinc-200 dark:bg-zinc-900 dark:text-white dark:hover:bg-zinc-700">
                            {{ __('Get started for free') }}
                        </a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="rounded-md px-6 py-3 text-sm font-semibold text-white ring-1 ring-white/30 transition hover:bg-white/10 dark:text-zinc-900 dark:ring-zinc-900/20 dark:hover:bg-zinc-100">
                            {{ __('Log in') }}
                        </a>
                    @endif
                @else
                    <a href="#features" class="rounded-md bg-white px-6 py-3 text-sm font-semibold text-zinc-900 transition hover:bg-zinc-200 dark:bg-zinc-900 dark:text-white dark:hover:bg-zinc-700">
                        {{ __('Explore features') }}
                    </a>
                @endguest
            </div>
        </div>
    </section>
@endsection
