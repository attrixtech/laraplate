<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title')@yield('title') | @endif{{ config('app.name', 'LaraPlate') }}</title>
    <meta name="description" content="@yield('meta_description', config('app.name', 'LaraPlate') . ' — a ready-to-use Laravel boilerplate.')">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    {{-- Apply the saved / preferred colour scheme before paint to avoid a flash --}}
    <script>
        (() => {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @vite(['resources/css/frontend/app.css', 'resources/js/frontend/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen bg-white font-sans text-zinc-800 antialiased dark:bg-zinc-950 dark:text-zinc-200">
    <div class="grid min-h-screen lg:grid-cols-2">
        {{-- Brand panel (desktop only) --}}
        <aside class="relative hidden overflow-hidden bg-zinc-900 p-12 text-white lg:flex lg:flex-col lg:justify-between dark:border-r dark:border-zinc-800">
            <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(to_right,rgb(255_255_255/0.04)_1px,transparent_1px),linear-gradient(to_bottom,rgb(255_255_255/0.04)_1px,transparent_1px)] bg-[size:48px_48px]"></div>
            <div class="pointer-events-none absolute -bottom-32 -left-32 size-96 rounded-full bg-white/5 blur-3xl"></div>

            <x-app-logo inverted class="relative" />

            <div class="relative max-w-md">
                <blockquote class="text-2xl font-medium leading-snug">
                    &ldquo;{{ __('Skip the boilerplate and get straight to building the features that matter.') }}&rdquo;
                </blockquote>
                <ul class="mt-8 space-y-3 text-sm text-zinc-300">
                    @foreach ([__('Secure authentication with two-factor & passkeys'), __('Email and mobile verification'), __('Roles, permissions and an admin area')] as $point)
                        <li class="flex items-center gap-3">
                            <svg class="size-5 shrink-0 text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <p class="relative text-sm text-zinc-400">&copy; {{ now()->year }} {{ config('app.name', 'LaraPlate') }}</p>
        </aside>

        {{-- Form panel --}}
        <div class="flex min-h-screen flex-col">
            <div class="flex items-center justify-between p-6">
                <x-app-logo class="lg:invisible" />
                <div class="flex items-center gap-1">
                    <a href="{{ route('frontend.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">
                        &larr; {{ __('Home') }}
                    </a>
                    <x-theme-toggle />
                </div>
            </div>

            <main id="main-content" class="flex flex-1 items-center justify-center px-6 pb-16">
                <div class="w-full max-w-sm">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
