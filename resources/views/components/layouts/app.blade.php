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
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>
    <flux:brand href="#" logo="{{asset('usericon.webp')}}" name="NativePHP" class="px-2 flex"/>
    <flux:navlist variant="outline">
        <flux:navlist.group :expanded="request()->routeIs('camera.*')" expandable heading="Camera">
            <flux:navlist.item icon="camera" href="{{route('camera.getPhoto')}}">Get Photo</flux:navlist.item>
            <flux:navlist.item icon="image-plus" href="{{route('camera.pickImages')}}">Pick Images</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group :expanded="request()->routeIs('haptics.*')" expandable heading="Haptics">
            <flux:navlist.item icon="vibrate" href="{{route('haptics.vibrate')}}">Vibrate</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group :expanded="request()->routeIs('browser.*')" expandable heading="Browser">
            <flux:navlist.item icon="globe-alt" href="{{route('browser.demo')}}">Demo</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group :expanded="request()->routeIs('push-notifications.*')" expandable
                            heading="Push Notifications">
            <flux:navlist.item icon="bell" href="{{route('push-notifications.demo')}}">Demo</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group :expanded="request()->routeIs('biometrics.*')" expandable heading="Biometrics">
            <flux:navlist.item icon="finger-print" href="{{route('biometrics.demo')}}">Demo</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group :expanded="request()->routeIs('system.*')" expandable heading="System">
            <flux:navlist.item icon="light-bulb" href="{{route('system.flashlight')}}">Flashlight</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group :expanded="request()->routeIs('geolocation.*')" expandable heading="Geolocation">
            <flux:navlist.item icon="map" href="{{route('geolocation.getCurrent')}}">Current Location
            </flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group :expanded="request()->routeIs('secure-storage.*')" expandable heading="Secure Storage">
            <flux:navlist.item icon="folder-lock" href="{{route('secure-storage.demo')}}">Demo</flux:navlist.item>
        </flux:navlist.group>

        <flux:navlist.group :expanded="request()->routeIs('dialog.*')" expandable heading="Dialog">
            <flux:navlist.item icon="share" href="{{route('dialog.share')}}">Share</flux:navlist.item>
            <flux:navlist.item icon="bell" href="{{route('dialog.alert')}}">Alert</flux:navlist.item>
            <flux:navlist.item icon="bolt" href="{{route('dialog.toast')}}">Toast</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group :expanded="false" expandable heading="Laravel">
            <flux:navlist.item icon="chat-bubble-left-right" href="{{route('laravel.reverb')}}">Reverb
            </flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>
    <flux:spacer/>
    <flux:navlist variant="outline">
        <flux:navlist.item icon="book-open" href="https://nativephp.com/docs/mobile/1/getting-started/introduction">
            Docs
        </flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="https://nativephp.com/mobile">Learn More</flux:navlist.item>
    </flux:navlist>
</flux:sidebar>
<flux:header>
    <flux:sidebar.toggle icon="bars-2" inset="left"/>
    <flux:spacer/>
    @if (\Native\Mobile\Facades\SecureStorage::get('token'))
        <flux:dropdown position="top" align="start">
            <flux:profile avatar="{{ asset('usericon.webp') }}"/>
            <flux:menu>
                <flux:navlist.item icon="arrow-right-start-on-rectangle" href=" {{route('logout')}}">
                    Logout
                </flux:navlist.item>
                <flux:menu.separator/>
                <livewire:auth.delete-account/>
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
