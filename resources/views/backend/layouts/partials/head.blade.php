<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@hasSection('title')@yield('title') | @endif{{ config('app.name', 'LaraPlate') }} {{ __('Admin') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

{{-- Apply the saved / preferred colour scheme before paint to avoid a flash --}}
<script>
    (() => {
        const theme = localStorage.getItem('theme');
        if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    })();
</script>

@vite(['resources/css/backend/app.css', 'resources/js/backend/app.js'])
@stack('styles')
