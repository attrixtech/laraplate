@php
    $footerLinks = [
        __('Product') => [
            ['label' => __('Features'), 'url' => route('frontend.index') . '#features'],
            ['label' => __('Stack'), 'url' => route('frontend.index') . '#stack'],
            ['label' => __('Get Started'), 'url' => route('frontend.index') . '#get-started'],
        ],
        __('Resources') => [
            ['label' => __('Laravel Docs'), 'url' => 'https://laravel.com/docs'],
            ['label' => __('Livewire'), 'url' => 'https://livewire.laravel.com'],
            ['label' => __('Tailwind CSS'), 'url' => 'https://tailwindcss.com'],
        ],
        __('Account') => array_values(array_filter([
            Route::has('login') ? ['label' => __('Log in'), 'url' => route('login')] : null,
            Route::has('register') ? ['label' => __('Register'), 'url' => route('register')] : null,
            Route::has('password.request') ? ['label' => __('Forgot password'), 'url' => route('password.request')] : null,
        ])),
    ];
@endphp

<footer class="border-t border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900/40">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-10 md:grid-cols-5">
            {{-- Brand --}}
            <div class="md:col-span-2">
                <x-app-logo />
                <p class="mt-4 max-w-sm text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                    {{ __('A ready-to-use Laravel boilerplate with a clean frontend / backend separation, authentication, roles & permissions and more.') }}
                </p>
            </div>

            {{-- Link columns --}}
            @foreach ($footerLinks as $heading => $links)
                <div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $heading }}</h3>
                    <ul class="mt-4 space-y-3">
                        @foreach ($links as $link)
                            <li>
                                <a href="{{ $link['url'] }}"
                                   class="text-sm text-zinc-600 transition-colors hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white"
                                   @if (\Illuminate\Support\Str::startsWith($link['url'], 'http') && ! \Illuminate\Support\Str::startsWith($link['url'], url('/'))) target="_blank" rel="noopener noreferrer" @endif>
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-zinc-200 pt-8 text-sm text-zinc-500 dark:border-zinc-800 dark:text-zinc-400 sm:flex-row">
            <p>&copy; {{ now()->year }} {{ config('app.name', 'LaraPlate') }}. {{ __('All rights reserved.') }}</p>
            <p>
                {{ __('Built with') }}
                <a href="https://laravel.com" target="_blank" rel="noopener noreferrer" class="font-medium text-zinc-700 hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-white">Laravel {{ app()->version() }}</a>
            </p>
        </div>
    </div>
</footer>
