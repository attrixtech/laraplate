@extends('auth.layouts.app')

@section('title', __('Forgot password'))

@section('content')
    <x-auth.header :title="__('Forgot your password?')"
                   :description="__('No problem. Enter your email address and we\'ll send you a link to reset it.')" />

    <x-auth.status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <x-form.input name="email" type="email" :label="__('Email address')" placeholder="you@example.com"
                      required autofocus autocomplete="email" />

        <x-form.button>{{ __('Email password reset link') }}</x-form.button>
    </form>

    <p class="mt-8 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Remembered it?') }}
        <a href="{{ route('login') }}" class="font-semibold text-zinc-900 hover:underline dark:text-white">{{ __('Back to log in') }}</a>
    </p>
@endsection
