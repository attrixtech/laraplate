@extends('auth.layouts.app')

@section('title', __('Verify mobile'))

@section('content')
    <x-auth.header :title="__('Verify your mobile number')"
                   :description="$user->mobile
                       ? __('We\'ll send a 6-digit verification code to :mobile.', ['mobile' => \Illuminate\Support\Str::mask($user->mobile, '•', 0, -4)])
                       : null">
        <div class="mb-6 grid size-12 place-items-center rounded-full bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-white">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
            </svg>
        </div>
    </x-auth.header>

    @if (blank($user->mobile))
        <x-auth.status type="warning" :status="__('There is no mobile number on your account yet. Add one to your profile to verify it.')" />
    @else
        @if (session('status') === 'verification-code-sent')
            <x-auth.status :status="__('A new verification code has been sent to your mobile number.')" />
        @endif

        <form method="POST" action="{{ route('mobile.verify.store') }}" class="space-y-5">
            @csrf

            <x-form.input name="code" :label="__('Verification code')" placeholder="000000"
                          inputmode="numeric" pattern="[0-9]*" maxlength="6" autocomplete="one-time-code"
                          class="text-center font-mono text-lg tracking-[0.5em]" required autofocus />

            <x-form.button>{{ __('Verify') }}</x-form.button>
        </form>

        <form method="POST" action="{{ route('mobile.verify.send') }}" class="mt-4">
            @csrf
            <x-form.button variant="secondary">{{ __('Send code') }}</x-form.button>
        </form>
    @endif

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <x-form.button variant="link">{{ __('Log out') }}</x-form.button>
    </form>
@endsection
