@extends('auth.layouts.app')

@section('title', __('Reset password'))

@section('content')
    <x-auth.header :title="__('Reset your password')" :description="__('Choose a new password for your account.')" />

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <x-form.input name="email" type="email" :label="__('Email address')" :value="request('email')"
                      required autocomplete="email" />

        <x-form.input name="password" type="password" :label="__('New password')" required autofocus autocomplete="new-password" />

        <x-form.input name="password_confirmation" type="password" :label="__('Confirm new password')" required autocomplete="new-password" />

        <x-form.button>{{ __('Reset password') }}</x-form.button>
    </form>

    <p class="mt-8 text-center text-sm text-zinc-600 dark:text-zinc-400">
        <a href="{{ route('login') }}" class="font-semibold text-zinc-900 hover:underline dark:text-white">{{ __('Back to log in') }}</a>
    </p>
@endsection
