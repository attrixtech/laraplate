@php
    $navGroups = [
        [
            'label' => __('Overview'),
            'items' => [
                [
                    'label' => __('Dashboard'),
                    'url' => route('admin.admin'),
                    'active' => request()->routeIs('admin.admin'),
                    'icon' => 'M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z',
                ],
            ],
        ],
        [
            'label' => __('Access Management'),
            'items' => [
                [
                    'label' => __('Users'),
                    'url' => '#users',
                    'active' => false,
                    'badge' => \App\Models\User::query()->count(),
                    'icon' => 'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z',
                ],
                [
                    'label' => __('Roles & Permissions'),
                    'url' => '#roles',
                    'active' => false,
                    'icon' => 'M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z',
                ],
            ],
        ],
        [
            'label' => __('Content & System'),
            'items' => array_values(array_filter([
                [
                    'label' => __('Media Library'),
                    'url' => '#media',
                    'active' => false,
                    'icon' => 'm2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z',
                ],
                Route::has('telescope') ? [
                    'label' => __('Telescope'),
                    'url' => route('telescope'),
                    'active' => false,
                    'external' => true,
                    'icon' => 'M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5',
                ] : null,
                [
                    'label' => __('Settings'),
                    'url' => '#settings',
                    'active' => false,
                    'icon' => 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z',
                ],
            ])),
        ],
    ];
@endphp

<aside id="admin-sidebar"
       class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col border-r border-zinc-200 bg-white transition-transform duration-200 ease-out dark:border-zinc-800 dark:bg-zinc-900 lg:translate-x-0"
       aria-label="{{ __('Admin sidebar') }}">
    {{-- Brand --}}
    <div class="flex h-16 shrink-0 items-center justify-between border-b border-zinc-200 px-5 dark:border-zinc-800">
        <div class="flex items-center gap-2">
            <x-app-logo :href="route('admin.admin')" />
            <span class="rounded-md bg-zinc-100 px-1.5 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                {{ __('Admin') }}
            </span>
        </div>

        <button type="button" data-sidebar-close
                class="grid size-8 place-items-center rounded-md text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white lg:hidden"
                aria-label="{{ __('Close sidebar') }}">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 space-y-6 overflow-y-auto px-3 py-5" aria-label="{{ __('Sidebar navigation') }}">
        @foreach ($navGroups as $group)
            <div>
                <p class="px-3 text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                    {{ $group['label'] }}
                </p>
                <ul class="mt-2 space-y-1">
                    @foreach ($group['items'] as $item)
                        <li>
                            <a href="{{ $item['url'] }}"
                               @if (! empty($item['external'])) target="_blank" rel="noopener noreferrer" @endif
                               @class([
                                   'group flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium transition-colors',
                                   'bg-zinc-900 text-white shadow-xs dark:bg-white dark:text-zinc-900' => $item['active'],
                                   'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800/80 dark:hover:text-white' => ! $item['active'],
                               ])
                               @if ($item['active']) aria-current="page" @endif>
                                <span class="flex items-center gap-3 truncate">
                                    <svg @class([
                                        'size-5 shrink-0 transition-colors',
                                        'text-white dark:text-zinc-900' => $item['active'],
                                        'text-zinc-400 group-hover:text-zinc-700 dark:text-zinc-500 dark:group-hover:text-zinc-200' => ! $item['active'],
                                    ]) xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                                    </svg>
                                    <span class="truncate">{{ $item['label'] }}</span>
                                </span>

                                @if (isset($item['badge']))
                                    <span @class([
                                        'rounded-full px-2 py-0.5 text-xs font-medium tabular-nums',
                                        'bg-white/20 text-white dark:bg-zinc-900/15 dark:text-zinc-900' => $item['active'],
                                        'bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400' => ! $item['active'],
                                    ])>
                                        {{ $item['badge'] }}
                                    </span>
                                @elseif (! empty($item['external']))
                                    <svg class="size-3.5 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </nav>

    {{-- Bottom link --}}
    <div class="border-t border-zinc-200 p-3 dark:border-zinc-800">
        <a href="{{ route('frontend.index') }}"
           class="flex items-center justify-between rounded-lg px-3 py-2 text-sm font-medium text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white">
            <span class="flex items-center gap-2.5">
                <svg class="size-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                </svg>
                {{ __('View storefront') }}
            </span>
            <span aria-hidden="true" class="text-xs text-zinc-400">&nearr;</span>
        </a>
    </div>
</aside>
