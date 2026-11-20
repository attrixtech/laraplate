<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('backend.layouts.partials.head')
</head>
<body class="min-h-screen bg-zinc-50 font-sans text-zinc-800 antialiased dark:bg-zinc-950 dark:text-zinc-200">
    <a href="#main-content"
       class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-md focus:bg-zinc-900 focus:px-4 focus:py-2 focus:text-white">
        {{ __('Skip to content') }}
    </a>

    {{-- Mobile sidebar backdrop --}}
    <div id="sidebar-backdrop" data-sidebar-close
         class="fixed inset-0 z-40 hidden bg-zinc-950/60 backdrop-blur-xs transition-opacity lg:hidden"
         aria-hidden="true"></div>

    <div class="flex min-h-screen">
        @include('backend.layouts.partials.sidebar')

        <div class="flex min-w-0 flex-1 flex-col lg:pl-64">
            @include('backend.layouts.partials.header')

            <main id="main-content" class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
                @if (session('status'))
                    <x-auth.status :status="session('status')" class="mb-6" />
                @endif

                @yield('content')
            </main>

            @include('backend.layouts.partials.footer')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
