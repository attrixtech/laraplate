@extends('auth.layouts.app')

@section('title', __('Confirm password'))

@section('content')
    <x-auth.header :title="__('Confirm your password')"
                   :description="__('This is a secure area of the application. Please confirm your password before continuing.')">
        <div class="mb-6 grid size-12 place-items-center rounded-full bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-white">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
            </svg>
        </div>
    </x-auth.header>

    <form method="POST" action="{{ route('password.confirm.store') }}" class="space-y-5">
        @csrf

        <x-form.input name="password" type="password" :label="__('Password')" required autofocus autocomplete="current-password" />

        <x-form.button>{{ __('Confirm') }}</x-form.button>
    </form>
@endsection
