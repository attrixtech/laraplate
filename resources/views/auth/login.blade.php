@extends('auth.layouts.app')

@section('title', __('Log in'))

@section('content')
    <x-auth.header :title="__('Welcome back')" :description="__('Log in to your account to continue.')" />

    <x-auth.status :status="session('status')" />

    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
        @csrf

        <x-form.input name="email" type="email" :label="__('Email address')" placeholder="you@example.com"
                      required autofocus autocomplete="email webauthn" />

        <x-form.input name="password" type="password" :label="__('Password')" required autocomplete="current-password">
            @if (Route::has('password.request'))
                <x-slot:label-aside>
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">
                        {{ __('Forgot password?') }}
                    </a>
                </x-slot:label-aside>
            @endif
        </x-form.input>

        <x-form.checkbox name="remember" :label="__('Remember me')" />

        <x-form.button>{{ __('Log in') }}</x-form.button>
    </form>

    @if (Route::has('passkey.login'))
        <div class="my-6 flex items-center gap-3 text-xs uppercase tracking-wider text-zinc-400">
            <span class="h-px flex-1 bg-zinc-200 dark:bg-zinc-800"></span>
            {{ __('or') }}
            <span class="h-px flex-1 bg-zinc-200 dark:bg-zinc-800"></span>
        </div>

        <x-form.button type="button" variant="secondary" data-passkey-login>
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
            </svg>
            <span data-passkey-label>{{ __('Sign in with a passkey') }}</span>
        </x-form.button>
        <p data-passkey-error class="mt-2 hidden text-center text-sm text-red-600 dark:text-red-400" role="alert"></p>
    @endif

    @if (Route::has('register'))
        <p class="mt-8 text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="font-semibold text-zinc-900 hover:underline dark:text-white">{{ __('Sign up') }}</a>
        </p>
    @endif
@endsection

@if (Route::has('passkey.login'))
    @push('scripts')
        @vite('resources/js/passkeys.js')
        <script>
            document.querySelector('[data-passkey-login]')?.addEventListener('click', async (event) => {
                const button = event.currentTarget;
                const label = button.querySelector('[data-passkey-label]');
                const error = document.querySelector('[data-passkey-error]');
                const original = label.textContent;

                if (!window.Passkeys?.isSupported()) {
                    error.textContent = @js(__('Passkeys are not supported on this browser or device.'));
                    error.classList.remove('hidden');
                    return;
                }

                button.disabled = true;
                label.textContent = @js(__('Waiting for passkey…'));
                error.classList.add('hidden');

                try {
                    const response = await window.Passkeys.verify();
                    window.location.href = response?.redirect ?? @js(url(config('fortify.home', '/')));
                } catch (e) {
                    error.textContent = e?.message || @js(__('Passkey authentication failed. Please try again.'));
                    error.classList.remove('hidden');
                    button.disabled = false;
                    label.textContent = original;
                }
            });
        </script>
    @endpush
@endif
