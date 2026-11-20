@extends('auth.layouts.app')

@section('title', __('Register'))

@section('content')
    <x-auth.header :title="__('Create an account')" :description="__('Enter your details below to get started.')" />

    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
        @csrf

        <div class="grid gap-5 sm:grid-cols-2">
            <x-form.input name="first_name" :label="__('First name')" required autofocus autocomplete="given-name" />
            <x-form.input name="last_name" :label="__('Last name')" required autocomplete="family-name" />
        </div>

        <x-form.input name="email" type="email" :label="__('Email address')" placeholder="you@example.com"
                      required autocomplete="email" />

        <x-form.input name="mobile" type="tel" :label="__('Mobile number')" placeholder="+1 555 123 4567"
                      inputmode="tel" autocomplete="tel" :hint="__('Optional. Include your country code.')" />

        <x-form.input name="password" type="password" :label="__('Password')" required autocomplete="new-password" />

        <x-form.input name="password_confirmation" type="password" :label="__('Confirm password')" required autocomplete="new-password" />

        <x-form.button>{{ __('Create account') }}</x-form.button>
    </form>

    <p class="mt-8 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}" class="font-semibold text-zinc-900 hover:underline dark:text-white">{{ __('Log in') }}</a>
    </p>
@endsection
