@extends('auth.layouts.app')

@section('title', __('Change password'))

@section('content')
    <x-auth.header :title="__('Change your password')"
                   :description="__('Use a long, random password to keep your account secure.')" />

    @if (session('status') === 'password-updated')
        <x-auth.status :status="__('Your password has been updated.')" />
    @endif

    <form method="POST" action="{{ route('user-password.update') }}" class="space-y-5">
        @csrf
        @method('PUT')

        <x-form.input name="current_password" type="password" bag="updatePassword" :label="__('Current password')"
                      required autofocus autocomplete="current-password" />

        <x-form.input name="password" type="password" bag="updatePassword" :label="__('New password')"
                      required autocomplete="new-password" />

        <x-form.input name="password_confirmation" type="password" bag="updatePassword" :label="__('Confirm new password')"
                      required autocomplete="new-password" />

        <x-form.button>{{ __('Update password') }}</x-form.button>
    </form>

    <p class="mt-8 text-center text-sm">
        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('frontend.index') }}"
           class="text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">&larr; {{ __('Go back') }}</a>
    </p>
@endsection
