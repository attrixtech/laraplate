<footer class="border-t border-zinc-200/80 px-4 py-4 text-xs text-zinc-500 dark:border-zinc-800/80 dark:text-zinc-400 sm:px-6 lg:px-8">
    <div class="flex flex-col items-center justify-between gap-2 sm:flex-row">
        <p>&copy; {{ now()->year }} {{ config('app.name', 'LaraPlate') }}. {{ __('All rights reserved.') }}</p>
        <p class="tabular-nums">Laravel {{ app()->version() }} &middot; PHP {{ PHP_VERSION }}</p>
    </div>
</footer>
