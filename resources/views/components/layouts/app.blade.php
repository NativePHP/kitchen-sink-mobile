<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite('resources/css/app.css')
    @fluxAppearance
</head>
<body
    class="bg-[#EFEFF6] dark:bg-[#080C20] min-h-screen">
<flux:sidebar sticky stashable
              class="bg-[#EFEFF6] dark:bg-[#080C20] border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-black">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>
    <flux:brand href="{{route('home')}}" logo="{{asset('/icon.png')}}" name="NativePHP Kitchen Sink" class="px-2 dark:hidden"/>
    <flux:brand href="{{route('home')}}" logo="{{asset('/icon.png')}}" name="NativePHP Kitchen Sink"
                class="px-2 hidden dark:flex"/>
    {{--    <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass"/>--}}
    <flux:navlist variant="outline">
        <flux:navlist.group expandable :expanded="false" heading="System" class=" lg:grid">
            <flux:navlist.item href="{{route('system.camera')}}">Camera</flux:navlist.item>
            <flux:navlist.item href="{{route('system.push-notifications')}}">Push Notifications</flux:navlist.item>
            <flux:navlist.item href="{{route('system.biometric-scanner')}}">Biometric Scanner</flux:navlist.item>
            <flux:navlist.item href="{{route('system.vibrate')}}">Vibrate</flux:navlist.item>
            <flux:navlist.item href="{{route('system.flashlight')}}">Flashlight</flux:navlist.item>
        </flux:navlist.group>
        <flux:navlist.group expandable :expanded="false" heading="Dialog" class=" lg:grid">
            <flux:navlist.item href="{{route('dialog.share')}}">Share</flux:navlist.item>
            <flux:navlist.item href="{{route('dialog.alert')}}">Alert</flux:navlist.item>
            <flux:navlist.item href="{{route('dialog.toast')}}">Toast</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>
    <flux:spacer/>
    <flux:navlist variant="outline">
        <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
    </flux:navlist>
    {{--    <flux:dropdown position="top" align="start" class="max-lg:hidden">--}}
    {{--        <flux:profile avatar="https://fluxui.dev/img/demo/user.png" name="Olivia Martin"/>--}}
    {{--        <flux:menu>--}}
    {{--            <flux:menu.radio.group>--}}
    {{--                <flux:menu.radio checked>Olivia Martin</flux:menu.radio>--}}
    {{--                <flux:menu.radio>Truly Delta</flux:menu.radio>--}}
    {{--            </flux:menu.radio.group>--}}
    {{--            <flux:menu.separator/>--}}
    {{--            <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>--}}
    {{--        </flux:menu>--}}
    {{--    </flux:dropdown>--}}
</flux:sidebar>
<flux:header class="lg:hidden">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>
    <flux:spacer/>
{{--    <flux:dropdown position="top" alignt="start">--}}
{{--        <flux:profile avatar="https://fluxui.dev/img/demo/user.png"/>--}}
{{--        <flux:menu>--}}
{{--            <flux:menu.radio.group>--}}
{{--                <flux:menu.radio checked>Olivia Martin</flux:menu.radio>--}}
{{--                <flux:menu.radio>Truly Delta</flux:menu.radio>--}}
{{--            </flux:menu.radio.group>--}}
{{--            <flux:menu.separator/>--}}
{{--            <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>--}}
{{--        </flux:menu>--}}
{{--    </flux:dropdown>--}}
</flux:header>
<flux:main>
   {{$slot}}
</flux:main>
@fluxScripts
</body>
</html>
