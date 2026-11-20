<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('frontend.layouts.partials.head')
</head>
<body class="flex min-h-screen flex-col bg-white font-sans text-zinc-800 antialiased dark:bg-zinc-950 dark:text-zinc-200">
    <a href="#main-content"
       class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-md focus:bg-zinc-900 focus:px-4 focus:py-2 focus:text-white">
        {{ __('Skip to content') }}
    </a>

    @include('frontend.layouts.partials.header')

    <main id="main-content" class="flex-1">
        @yield('content')
    </main>

    @include('frontend.layouts.partials.footer')

    @stack('scripts')
</body>
</html>
