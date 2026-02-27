<!DOCTYPE html>
<html class="min-h-screen" lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, viewport-fit=cover">

    <title>Laravel</title>
{{--    <script src="https://cdn.tailwindcss.com/3.2.1"></script>--}}

        @vite('resources/css/app.css')
    @fluxAppearance

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="min-h-screen bg-zinc-50 dark:bg-zinc-900 overflow-x-hidden">
<livewire:native-edge :title="$title ?? 'Dashboard'" />

<flux:main class="!p-0 overflow-x-hidden">
    {{ $slot }}
</flux:main>

@fluxScripts
</body>
</html>
