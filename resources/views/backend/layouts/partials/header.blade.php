@php
    $user = auth()->user();
    $crumbs = \Tabuna\Breadcrumbs\Breadcrumbs::has() ? \Tabuna\Breadcrumbs\Breadcrumbs::current() : collect();
@endphp

<header class="sticky top-0 z-30 flex h-16 shrink-0 items-center justify-between gap-4 border-b border-zinc-200/80 bg-white/85 px-4 backdrop-blur-md dark:border-zinc-800/80 dark:bg-zinc-950/85 sm:px-6 lg:px-8">
    <div class="flex min-w-0 items-center gap-3">
        {{-- Mobile sidebar toggle --}}
        <button type="button" data-sidebar-toggle
                class="grid size-9 shrink-0 place-items-center rounded-md text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white lg:hidden"
                aria-controls="admin-sidebar" aria-expanded="false" aria-label="{{ __('Open sidebar') }}">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        {{-- Breadcrumbs / Page title --}}
        <nav aria-label="{{ __('Breadcrumb') }}" class="min-w-0">
            @if ($crumbs->isNotEmpty())
                <ol class="flex items-center gap-2 text-sm">
                    @foreach ($crumbs as $crumb)
                        @unless ($loop->first)
                            <li aria-hidden="true" class="text-zinc-400">/</li>
                        @endunless
                        <li class="truncate">
                            @if ($crumb->url() && ! $loop->last)
                                <a href="{{ $crumb->url() }}" class="text-zinc-500 transition-colors hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">
                                    {{ $crumb->title() }}
                                </a>
                            @else
                                <span class="font-medium text-zinc-900 dark:text-white">{{ $crumb->title() }}</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            @else
                <p class="truncate text-sm font-medium text-zinc-900 dark:text-white">
                    @yield('title', __('Dashboard'))
                </p>
            @endif
        </nav>
    </div>

    {{-- Right actions --}}
    <div class="flex items-center gap-2 sm:gap-3">
        {{-- Search --}}
        <div class="relative hidden md:block">
            <svg class="pointer-events-none absolute left-3 top-1/2 size-4 -translate-y-1/2 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="search" data-admin-search
                   placeholder="{{ __('Search…') }}"
                   aria-label="{{ __('Search admin') }}"
                   class="w-56 rounded-lg border border-zinc-200 bg-zinc-50 py-1.5 pl-9 pr-12 text-sm text-zinc-900 transition placeholder:text-zinc-400 focus:w-72 focus:border-zinc-400 focus:bg-white focus:outline-none dark:border-zinc-800 dark:bg-zinc-900 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-zinc-600 dark:focus:bg-zinc-900">
            <kbd class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 rounded border border-zinc-200 bg-white px-1.5 py-0.5 font-sans text-[10px] font-medium text-zinc-400 dark:border-zinc-700 dark:bg-zinc-800">
                ⌘K
            </kbd>
        </div>

        <x-theme-toggle />

        {{-- Account dropdown --}}
        @if ($user)
            <div class="relative" data-dropdown>
                <button type="button" data-dropdown-toggle
                        class="flex items-center gap-2.5 rounded-lg p-1 pr-2 text-left transition-colors hover:bg-zinc-100 dark:hover:bg-zinc-800"
                        aria-expanded="false" aria-haspopup="menu">
                    <span class="grid size-8 place-items-center rounded-full bg-zinc-900 text-xs font-semibold text-white dark:bg-white dark:text-zinc-900">
                        {{ $user->initials() }}
                    </span>
                    <span class="hidden text-sm sm:block">
                        <span class="block font-medium leading-none text-zinc-900 dark:text-white">{{ $user->name }}</span>
                        <span class="mt-0.5 block text-xs text-zinc-500 dark:text-zinc-400">{{ $user->email }}</span>
                    </span>
                    <svg class="hidden size-4 text-zinc-400 sm:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                <div data-dropdown-menu role="menu"
                     class="absolute right-0 mt-2 hidden w-56 origin-top-right rounded-xl border border-zinc-200 bg-white p-1.5 shadow-lg dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="border-b border-zinc-100 px-3 py-2 dark:border-zinc-800 sm:hidden">
                        <p class="truncate text-sm font-medium text-zinc-900 dark:text-white">{{ $user->name }}</p>
                        <p class="truncate text-xs text-zinc-500 dark:text-zinc-400">{{ $user->email }}</p>
                    </div>

                    <a href="{{ route('password.change') }}" role="menuitem"
                       class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800">
                        <svg class="size-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                        </svg>
                        {{ __('Change password') }}
                    </a>

                    <a href="{{ route('lock-screen') }}" role="menuitem"
                       class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800">
                        <svg class="size-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        {{ __('Lock screen') }}
                    </a>

                    <div class="my-1 border-t border-zinc-100 dark:border-zinc-800"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" role="menuitem"
                                class="flex w-full items-center gap-2.5 rounded-lg px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/50">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            {{ __('Log out') }}
                        </button>
                    </form>
                </div>
            </div>
        @elseif (Route::has('login'))
            <a href="{{ route('login') }}"
               class="rounded-md bg-zinc-900 px-3.5 py-2 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                {{ __('Log in') }}
            </a>
        @endif
    </div>
</header>
