@props(['title', 'description' => null])

<div {{ $attributes->class('mb-8') }}>
    {{ $slot }}
    <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">{{ $title }}</h1>
    @if ($description)
        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">{{ $description }}</p>
    @endif
</div>
