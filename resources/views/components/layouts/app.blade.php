<!DOCTYPE html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite('resources/css/app.css')
    @fluxStyles
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
<flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
    <flux:brand href="#" logo="{{asset('usericon.webp')}}" name="NativePHP" class="px-2 flex" />
    <flux:navlist variant="outline">
        <flux:navlist.group :expanded="false" expandable heading="System" >
            <flux:navlist.item icon="camera" href="{{route('system.camera')}}">Camera</flux:navlist.item>
            <flux:navlist.item icon="light-bulb" href="{{route('system.flashlight')}}">Flashlight</flux:navlist.item>
            <flux:navlist.item icon="finger-print" href="{{route('system.biometric-scanner')}}">Biometric Scanner</flux:navlist.item>
            <flux:navlist.item icon="bell" href="{{route('system.push-notifications')}}">Push Notifications</flux:navlist.item>
            <flux:navlist.item icon="fire" href="{{route('system.vibrate')}}">Vibrate</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group :expanded="false" expandable heading="Dialog" >
            <flux:navlist.item icon="share" href="{{route('dialog.share')}}">Share</flux:navlist.item>
            <flux:navlist.item icon="bell" href="{{route('dialog.alert')}}">Alert</flux:navlist.item>
            <flux:navlist.item icon="bolt" href="{{route('dialog.toast')}}">Toast</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group :expanded="false" expandable heading="Laravel" >
            <flux:navlist.item icon="chat-bubble-left-right" href="{{route('laravel.reverb')}}">Reverb</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>
    <flux:spacer />
    <flux:navlist variant="outline">
        <flux:navlist.item icon="book-open" href="https://nativephp.com/docs/mobile/1/getting-started/introduction">Docs</flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="https://nativephp.com/mobile">Learn More</flux:navlist.item>
    </flux:navlist>
</flux:sidebar>
<flux:header class="lg:hidden">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
    <flux:spacer />
    @if (\Native\Mobile\Facades\System::secureGet('token'))
        <flux:dropdown position="top" align="start">
            <flux:profile avatar="{{ asset('usericon.webp') }}" />
            <flux:menu>
                <flux:navlist.item icon="book-open" href=" {{route('logout')}}">Logout</flux:navlist.item>
            </flux:menu>
        </flux:dropdown>
    @endif
</flux:header>
<flux:main>
    {{ $slot }}
</flux:main>
@vite('resources/js/app.js')
@fluxScripts
</body>
</html>
