@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'hint' => null,
    'bag' => 'default',
])

@php
    $id = $attributes->get('id', $name);
    $errorBag = $errors->getBag($bag);
    $hasError = $errorBag->has($name);
    $isPassword = $type === 'password';
    $describedBy = $hasError ? "{$id}-error" : ($hint ? "{$id}-hint" : null);
@endphp

<div>
    @if ($label || isset($labelAside))
        <div class="flex items-center justify-between">
            @if ($label)
                <label for="{{ $id }}" class="block text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $label }}</label>
            @endif
            {{ $labelAside ?? '' }}
        </div>
    @endif

    <div @class(['relative', 'mt-1.5' => $label])>
        <input id="{{ $id }}"
               name="{{ $name }}"
               type="{{ $type }}"
               @unless ($isPassword) value="{{ old($name, $value) }}" @endunless
               @if ($hasError) aria-invalid="true" @endif
               @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
               {{ $attributes->except('id')->class([
                   'block w-full rounded-md border bg-white px-3 py-2 text-sm text-zinc-900 shadow-xs transition placeholder:text-zinc-400 focus:outline-none focus:ring-2 disabled:cursor-not-allowed disabled:opacity-60 dark:bg-zinc-900 dark:text-white dark:placeholder:text-zinc-500',
                   'pr-10' => $isPassword,
                   'border-red-500 focus:border-red-500 focus:ring-red-500/20' => $hasError,
                   'border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900/10 dark:border-zinc-700 dark:focus:border-zinc-400 dark:focus:ring-white/10' => ! $hasError,
               ]) }}>

        @if ($isPassword)
            <button type="button" data-password-toggle
                    class="absolute inset-y-0 right-0 grid w-10 place-items-center text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200"
                    aria-label="{{ __('Show password') }}" aria-pressed="false">
                <svg data-icon="show" class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <svg data-icon="hide" class="hidden size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>
            </button>
        @endif
    </div>

    @if ($hasError)
        <p id="{{ $id }}-error" class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $errorBag->first($name) }}</p>
    @elseif ($hint)
        <p id="{{ $id }}-hint" class="mt-1.5 text-xs text-zinc-500 dark:text-zinc-400">{{ $hint }}</p>
    @endif
</div>
