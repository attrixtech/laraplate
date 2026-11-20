@props(['name', 'label', 'checked' => false])

@php($id = $attributes->get('id', $name))

<label for="{{ $id }}" class="inline-flex cursor-pointer items-center gap-2 text-sm text-zinc-700 dark:text-zinc-300">
    <input id="{{ $id }}" name="{{ $name }}" type="checkbox" value="1"
           @checked(old($name, $checked))
           {{ $attributes->except('id')->class('size-4 rounded border-zinc-300 accent-zinc-900 dark:border-zinc-600 dark:accent-white') }}>
    <span>{{ $label }}</span>
</label>
