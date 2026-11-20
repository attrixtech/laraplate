@props(['variant' => 'primary'])

<button {{ $attributes->merge(['type' => 'submit'])->class([
    'inline-flex w-full items-center justify-center gap-2 rounded-md px-4 py-2.5 text-sm font-semibold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-60 dark:focus-visible:ring-offset-zinc-950',
    'bg-zinc-900 text-white shadow-sm hover:bg-zinc-700 focus-visible:ring-zinc-900 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 dark:focus-visible:ring-white' => $variant === 'primary',
    'border border-zinc-300 bg-white text-zinc-900 hover:bg-zinc-50 focus-visible:ring-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white dark:hover:bg-zinc-800' => $variant === 'secondary',
    'text-zinc-600 underline-offset-4 hover:text-zinc-900 hover:underline dark:text-zinc-400 dark:hover:text-white' => $variant === 'link',
]) }}>
    {{ $slot }}
</button>
