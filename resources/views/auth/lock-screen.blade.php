@extends('auth.layouts.app')

@section('title', __('Locked'))

@section('content')
    <div class="mb-8 text-center">
        <div class="mx-auto grid size-20 place-items-center rounded-full bg-zinc-900 text-2xl font-semibold text-white ring-4 ring-zinc-100 dark:bg-white dark:text-zinc-900 dark:ring-zinc-800">
            {{ $user->initials() }}
        </div>
        <h1 class="mt-5 text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">{{ $user->name }}</h1>
        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $user->email }}</p>
        <p class="mt-4 inline-flex items-center gap-1.5 rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
            {{ __('Screen locked') }}
        </p>
    </div>

    <form method="POST" action="{{ route('lock-screen.unlock') }}" class="space-y-5">
        @csrf

        <x-form.input name="password" type="password" :label="__('Enter your password to unlock')"
                      required autofocus autocomplete="current-password" />

        <x-form.button>{{ __('Unlock') }}</x-form.button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-6 text-center text-sm text-zinc-600 dark:text-zinc-400">
        @csrf
        {{ __('Not you?') }}
        <button type="submit" class="font-semibold text-zinc-900 hover:underline dark:text-white">{{ __('Sign in as a different user') }}</button>
    </form>
@endsection
