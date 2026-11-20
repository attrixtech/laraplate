@extends('auth.layouts.app')

@section('title', __('Two-factor authentication'))

@php($mode = $errors->has('recovery_code') ? 'recovery' : 'code')

@section('content')
    <x-auth.header :title="__('Two-factor authentication')" />

    <form method="POST" action="{{ route('two-factor.login.store') }}" class="space-y-5">
        @csrf

        <div data-2fa-panel="code" @if ($mode !== 'code') hidden @endif class="space-y-5">
            <p class="-mt-4 text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('Enter the 6-digit code from your authenticator app to continue.') }}
            </p>
            <x-form.input name="code" :label="__('Authentication code')" placeholder="000000"
                          inputmode="numeric" pattern="[0-9]*" maxlength="6" autocomplete="one-time-code"
                          class="text-center font-mono text-lg tracking-[0.5em]"
                          :autofocus="$mode === 'code'" :disabled="$mode !== 'code'" />
        </div>

        <div data-2fa-panel="recovery" @if ($mode !== 'recovery') hidden @endif class="space-y-5">
            <p class="-mt-4 text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('Enter one of your emergency recovery codes to continue.') }}
            </p>
            <x-form.input name="recovery_code" :label="__('Recovery code')" placeholder="abcdefghij-klmnopqrst"
                          autocomplete="off" class="font-mono"
                          :autofocus="$mode === 'recovery'" :disabled="$mode !== 'recovery'" />
        </div>

        <x-form.button>{{ __('Continue') }}</x-form.button>
    </form>

    <p class="mt-6 text-center text-sm text-zinc-600 dark:text-zinc-400">
        <button type="button" data-2fa-switch class="font-semibold text-zinc-900 hover:underline dark:text-white">
            <span data-2fa-label="code" @if ($mode !== 'code') hidden @endif>{{ __('Use a recovery code instead') }}</span>
            <span data-2fa-label="recovery" @if ($mode !== 'recovery') hidden @endif>{{ __('Use an authentication code instead') }}</span>
        </button>
    </p>

    <p class="mt-4 text-center text-sm">
        <a href="{{ route('login') }}" class="text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">{{ __('Back to log in') }}</a>
    </p>
@endsection

@push('scripts')
    <script>
        document.querySelector('[data-2fa-switch]')?.addEventListener('click', () => {
            document.querySelectorAll('[data-2fa-panel]').forEach((panel) => {
                const show = panel.hidden;
                panel.hidden = !show;
                panel.querySelectorAll('input').forEach((input) => {
                    input.disabled = !show;
                    if (show) input.focus();
                });
            });
            document.querySelectorAll('[data-2fa-label]').forEach((label) => (label.hidden = !label.hidden));
        });
    </script>
@endpush
