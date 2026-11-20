@props(['href' => null, 'inverted' => false])

<a href="{{ $href ?? route('frontend.index') }}" {{ $attributes->class('flex items-center gap-2 text-lg font-semibold tracking-tight') }}>
    <span @class([
        'grid size-8 place-items-center rounded-lg text-sm font-bold',
        'bg-white text-zinc-900' => $inverted,
        'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' => ! $inverted,
    ])>
        {{ \Illuminate\Support\Str::of(config('app.name', 'LaraPlate'))->substr(0, 1)->upper() }}
    </span>
    <span>{{ config('app.name', 'LaraPlate') }}</span>
</a>
