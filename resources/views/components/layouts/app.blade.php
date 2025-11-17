<!DOCTYPE html>
<html class="min-h-screen" lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <title>Laravel</title>


    @vite('resources/css/app.css')
    @fluxAppearance
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="min-h-screen bg-zinc-50 dark:bg-zinc-900  nativephp-safe-area">
<livewire:native-edge :title="$title ?? 'Dashboard'" />

<flux:main class="!p-2">
    {{ $slot }}
</flux:main>

@vite('resources/js/app.js')
@fluxScripts
</body>
</html>
