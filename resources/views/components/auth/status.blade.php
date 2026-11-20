@props(['status' => null, 'type' => 'success'])

@if ($status)
    <div role="status" {{ $attributes->class([
        'mb-6 flex items-start gap-3 rounded-md border px-4 py-3 text-sm',
        'border-emerald-200 bg-emerald-50 text-emerald-800 dark:border-emerald-900 dark:bg-emerald-950/50 dark:text-emerald-300' => $type === 'success',
        'border-amber-200 bg-amber-50 text-amber-800 dark:border-amber-900 dark:bg-amber-950/50 dark:text-amber-300' => $type === 'warning',
    ]) }}>
        <svg class="mt-0.5 size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
            @if ($type === 'success')
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            @else
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            @endif
        </svg>
        <span>{{ $status }}</span>
    </div>
@endif
