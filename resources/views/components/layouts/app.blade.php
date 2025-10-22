<!DOCTYPE html>
<html class="" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
<body class="min-h-screen bg-zinc-200 dark:bg-zinc-900 pt-4">
<native:side-nav dark="true">
    <native:side-nav-group heading="Camera" :expanded="request()->routeIs('camera.*')">
        <native:side-nav-item active="{{request()->routeIs('camera.getPhoto')}}" id="camera-get-photo" icon="camera" url="{{route('camera.getPhoto')}}" label="Get Photo"/>
        <native:side-nav-item active="{{request()->routeIs('camera.pickImages')}}" id="camera-pick-images" icon="image-plus" url="{{route('camera.pickImages')}}" label="Pick Images"/>
    </native:side-nav-group>
    <native:side-nav-group heading="Device Info" :expanded="request()->routeIs('device.demo')">
        <native:side-nav-item active="{{request()->routeIs('device.demo')}}" id="device-demo" icon="device-phone-mobile" url="{{route('device.demo')}}" label="Demo"/>
    </native:side-nav-group>
    <native:side-nav-group heading="Haptics" :expanded="request()->routeIs('haptics.*')">
        <native:side-nav-item active="{{request()->routeIs('haptics.vibrate')}}" id="haptics-vibrate" icon="vibrate" url="{{route('haptics.vibrate')}}" label="Vibrate"/>
    </native:side-nav-group>
    <native:side-nav-group heading="Browser" :expanded="request()->routeIs('browser.*')">
        <native:side-nav-item active="{{request()->routeIs('browser.demo')}}" id="browser-demo" icon="globe-alt" url="{{route('browser.demo')}}" label="Demo"/>
    </native:side-nav-group>
    <native:side-nav-group heading="Push Notifications" :expanded="request()->routeIs('push-notifications.*')">
        <native:side-nav-item active="{{request()->routeIs('push-notifications.demo')}}" id="push-notifications-demo" icon="bell" url="{{route('push-notifications.demo')}}" label="Demo"/>
    </native:side-nav-group>
    <native:side-nav-group heading="Biometrics" :expanded="request()->routeIs('biometrics.*')">
        <native:side-nav-item active="{{request()->routeIs('biometrics.demo')}}" id="biometrics-demo" icon="finger-print" url="{{route('biometrics.demo')}}" label="Demo"/>
    </native:side-nav-group>
    <native:side-nav-group heading="System" :expanded="request()->routeIs('system.*')">
        <native:side-nav-item active="{{request()->routeIs('system.flashlight')}}" id="system-flashlight" icon="light-bulb" url="{{route('system.flashlight')}}" label="Flashlight"/>
    </native:side-nav-group>
    <native:side-nav-group heading="Geolocation" :expanded="request()->routeIs('geolocation.*')">
        <native:side-nav-item active="{{request()->routeIs('geolocation.getCurrent')}}" id="geolocation-get-current" icon="map" url="{{route('geolocation.getCurrent')}}" label="Current Location"/>
    </native:side-nav-group>
    <native:side-nav-group heading="Secure Storage" :expanded="request()->routeIs('secure-storage.*')">
        <native:side-nav-item active="{{request()->routeIs('secure-storage.demo')}}" id="secure-storage-demo" icon="folder-lock" url="{{route('secure-storage.demo')}}" label="Demo"/>
    </native:side-nav-group>
    <native:side-nav-group heading="Dialog" :expanded="request()->routeIs('dialog.*')">
        <native:side-nav-item active="{{request()->routeIs('dialog.share')}}" id="dialog-share" icon="share" url="{{route('dialog.share')}}" label="Share"/>
        <native:side-nav-item active="{{request()->routeIs('dialog.alert')}}" id="dialog-alert" icon="bell" url="{{route('dialog.alert')}}" label="Alert"/>
        <native:side-nav-item active="{{request()->routeIs('dialog.toast')}}" id="dialog-toast" icon="bolt" url="{{route('dialog.toast')}}" label="Toast"/>
    </native:side-nav-group>
    <native:side-nav-group heading="Laravel" :expanded="false">
        <native:side-nav-item active="{{request()->routeIs('laravel.reverb')}}" id="laravel-reverb" icon="chat-bubble-left-right" url="{{route('laravel.reverb')}}" label="Reverb"/>
    </native:side-nav-group>
    <native:side-nav-group heading="Resources" :expanded="false">
        <native:side-nav-item id="docs" icon="book-open" url="https://nativephp.com/docs/mobile/1/getting-started/introduction" label="Docs"/>
        <native:side-nav-item id="learn-more" icon="information-circle" url="https://nativephp.com/mobile" label="Learn More"/>
    </native:side-nav-group>
</native:side-nav>

<flux:main>
    {{ $slot }}
</flux:main>
@vite('resources/js/app.js')
@fluxScripts
</body>
</html>
