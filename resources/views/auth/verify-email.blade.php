@extends('auth.layouts.app')

@section('title', __('Verify email'))

@section('content')
    <x-auth.header :title="__('Verify your email address')"
                   :description="__('Thanks for signing up! Please verify your email address by clicking the link we just emailed to :email.', ['email' => auth()->user()->email])">
        <div class="mb-6 grid size-12 place-items-center rounded-full bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-white">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
        </div>
    </x-auth.header>

    @if (session('status') === 'verification-link-sent')
        <x-auth.status :status="__('A new verification link has been sent to your email address.')" />
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <x-form.button>{{ __('Resend verification email') }}</x-form.button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <x-form.button variant="link">{{ __('Log out') }}</x-form.button>
    </form>
@endsection
