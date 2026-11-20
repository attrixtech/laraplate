@php
    $navigation = [
        ['label' => __('Home'), 'url' => route('frontend.index'), 'active' => request()->routeIs('frontend.index')],
        ['label' => __('Features'), 'url' => route('frontend.index') . '#features', 'active' => false],
        ['label' => __('Stack'), 'url' => route('frontend.index') . '#stack', 'active' => false],
        ['label' => __('Get Started'), 'url' => route('frontend.index') . '#get-started', 'active' => false],
    ];

    $linkClasses = 'rounded-md px-3 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white';
    $primaryClasses = 'rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200';
@endphp

<header class="sticky top-0 z-40 border-b border-zinc-200/80 bg-white/80 backdrop-blur-md dark:border-zinc-800/80 dark:bg-zinc-950/80">
    <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8" aria-label="{{ __('Main navigation') }}">
        <x-app-logo />

        {{-- Desktop links --}}
        <ul class="hidden items-center gap-1 md:flex">
            @foreach ($navigation as $item)
                <li>
                    <a href="{{ $item['url'] }}"
                       @class([
                           'rounded-md px-3 py-2 text-sm font-medium transition-colors',
                           'text-zinc-900 dark:text-white' => $item['active'],
                           'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white' => ! $item['active'],
                       ])
                       @if ($item['active']) aria-current="page" @endif>
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Actions --}}
        <div class="flex items-center gap-2">
            <x-theme-toggle />

            <div class="hidden items-center gap-2 md:flex">
                @auth
                    <span class="px-1 text-sm font-medium text-zinc-900 dark:text-white">{{ auth()->user()->name }}</span>
                    @if (Route::has('admin.admin'))
                        <a href="{{ route('admin.admin') }}" class="{{ $linkClasses }}">{{ __('Admin') }}</a>
                    @endif
                    <a href="{{ route('password.change') }}" class="{{ $linkClasses }}">{{ __('Change password') }}</a>
                    <a href="{{ route('lock-screen') }}" class="{{ $linkClasses }}" title="{{ __('Lock screen') }}">
                        <span class="sr-only">{{ __('Lock screen') }}</span>
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="{{ $primaryClasses }}">{{ __('Log out') }}</button>
                    </form>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="{{ $linkClasses }}">{{ __('Log in') }}</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="{{ $primaryClasses }}">{{ __('Register') }}</a>
                    @endif
                @endauth
            </div>

            {{-- Mobile menu button --}}
            <button type="button" data-menu-toggle
                    class="grid size-9 place-items-center rounded-md text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800 md:hidden"
                    aria-controls="mobile-menu" aria-expanded="false" aria-label="{{ __('Open main menu') }}">
                <svg data-menu-icon="open" class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg data-menu-icon="close" class="hidden size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="hidden border-t border-zinc-200 dark:border-zinc-800 md:hidden">
        <ul class="space-y-1 px-4 py-3">
            @foreach ($navigation as $item)
                <li>
                    <a href="{{ $item['url'] }}"
                       @class([
                           'block rounded-md px-3 py-2 text-base font-medium',
                           'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-white' => $item['active'],
                           'text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-900' => ! $item['active'],
                       ])>
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="border-t border-zinc-200 px-4 py-3 dark:border-zinc-800">
            @auth
                <p class="px-3 pb-2 text-sm font-medium text-zinc-900 dark:text-white">{{ auth()->user()->name }}</p>
                @if (Route::has('admin.admin'))
                    <a href="{{ route('admin.admin') }}" class="block rounded-md px-3 py-2 text-base font-medium text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-900">{{ __('Admin') }}</a>
                @endif
                <a href="{{ route('password.change') }}" class="block rounded-md px-3 py-2 text-base font-medium text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-900">{{ __('Change password') }}</a>
                <a href="{{ route('lock-screen') }}" class="block rounded-md px-3 py-2 text-base font-medium text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-900">{{ __('Lock screen') }}</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white dark:bg-white dark:text-zinc-900">
                        {{ __('Log out') }}
                    </button>
                </form>
            @else
                <div class="flex gap-2">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="flex-1 rounded-md border border-zinc-300 px-4 py-2 text-center text-sm font-medium dark:border-zinc-700">
                            {{ __('Log in') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="flex-1 rounded-md bg-zinc-900 px-4 py-2 text-center text-sm font-medium text-white dark:bg-white dark:text-zinc-900">
                            {{ __('Register') }}
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</header>
