<!DOCTYPE html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite('resources/css/app.css')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="bg-white dark:bg-[#050714] min-h-screen text-gray-900 dark:text-white" >
<div x-data="{ sidebarOpen: false }" class="relative z-50" role="dialog" aria-modal="true" x-cloak>
    <!-- Toggle Button -->
    <div
        class="sticky top-0 z-40 flex items-center justify-between bg-gradient-to-r from-[#352F5B] to-[#6056AA] px-4 py-4 shadow-sm"
        x-data="{ showDropdown: false }"
    >
        <!-- Sidebar toggle -->
        <button @click="sidebarOpen = true" type="button" class="-m-2.5 p-2.5 text-indigo-200">
            <span class="sr-only">Open sidebar</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
        </button>

        <!-- Profile + Dropdown -->
        @if (session()->has('token'))
            <div class="relative" x-data="{ showDropdown: false }">
                <button @click="showDropdown = !showDropdown" type="button" class="relative z-10">
                    <img class="size-8 rounded-full " src="{{ asset('usericon.webp') }}" alt="User">
                </button>

                <div
                    x-show="showDropdown"
                    @click.outside="showDropdown = false"
                    x-transition
                    class="absolute right-0 mt-2 w-40 rounded-md bg-white dark:bg-[#080C20] shadow-lg ring-1 ring-black ring-opacity-5 z-50"
                >
                    <a href="{{route('logout')}}" type="submit"
                       class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-white">
                        Logout
                    </a>
                </div>
            </div>
        @endif
    </div>


    <!-- Overlay -->
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/90 z-40"
        aria-hidden="true">
    </div>

    <!-- Sidebar -->
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition ease-in-out duration-150 transform"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-150 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-0 z-50 flex flex-col bg-white dark:bg-[#0a0c1c] px-6 pb-4 w-4/5"
    >
        <!-- Close Button -->
        <div class="flex justify-end pt-4">
            <button @click="sidebarOpen = false" class="text-[#505b93] dark:text-[#8696ed]">
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <svg class="h-4 min-[400px]:h-5 sm:h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 764 100">
            <path class="text-[#505b93] dark:text-[#8696ed]" fill="currentColor" d="M29.5,98.4H0V1.2h29.5V98.4z"></path>
            <path class="text-[#00aaa6] dark:text-[#3edad7]" fill="currentColor" d="M96.7,98.4H67.2V1.2h29.5V98.4z"></path>
            <path class="text-[#272d48]" fill="currentColor" d="M96.7,98.4H29.5V1.2L96.7,98.4z"></path>
            <path class="text-[#272d48] dark:text-white" fill="currentColor" d="M102.6,54.5c0-6.2,1.3-11.8,4.1-16.7c2.7-5,6.7-8.8,11.9-11.6c5.2-2.8,11.4-4.2,18.6-4.2c1.1,0,2.8,0.1,5.2,0.3 c4.9,0.4,9.1,1.3,12.5,2.8c3.4,1.5,6.4,3.4,9.1,5.9v-7.2h25.8v74.7h-25.8v-7.2c-2.5,2.6-5.6,4.6-9.4,6.1c-3.8,1.5-7.9,2.4-12.1,2.6 c-0.9,0.1-2.3,0.1-4.1,0.1c-7.2,0-13.4-1.4-18.8-4.1c-5.4-2.7-9.5-6.6-12.4-11.5c-2.9-4.9-4.3-10.5-4.3-16.6V54.5z M128.4,63.9 c0,9.2,5.9,13.8,17.7,13.8c11.8,0,17.7-4.6,17.7-13.8v-5.6c0-9.3-5.9-14-17.7-14c-11.8,0-17.7,4.7-17.7,14V63.9z M208.3,98.4V47h-12.8V23.7l12.8-0.2V1.2h25.9l0.1,22.4h18.3V47h-18.4v51.4 M287.3,98.4h-25.9V23.6h25.9V98.4z M351,98.4H325l-31-74.8H320L338,68l18-44.5h25.9L351,98.4z M454.9,87.6c-4.1,4.2-8.8,7.3-14.1,9.3c-5.3,2-11.8,2.9-19.5,2.9c-8,0-15.1-1.4-21.3-4.2 c-6.2-2.8-11.1-6.7-14.7-11.6c-3.5-5-5.3-10.6-5.3-17V54.6c0-6.5,1.7-12.2,5.2-17.1c3.4-4.9,8.2-8.7,14.2-11.3c6-2.7,12.7-4,20-4 c8,0,15,1.5,21.2,4.3c6.1,2.9,10.9,7,14.4,12.4c3.4,5.4,5.2,11.6,5.2,18.7c0,1.7-0.2,4.2-0.7,7.7l-54.2,0.1v2.1 c0,4.1,1.5,7.3,4.4,9.4c2.9,2.2,6.9,3.2,11.8,3.2c4.6,0,8.5-0.6,11.8-1.8c3.2-1.2,6.4-3.5,9.4-6.8L454.9,87.6z M434.4,51.4 c0-3.1-1.4-5.5-4.2-7.1c-2.8-1.6-6.4-2.4-10.8-2.4s-7.9,0.8-10.5,2.4c-2.6,1.6-3.8,4-3.8,7.1H434.4z M466,98.4V1.2h56c9.9,0,17.8,1.9,23.7,5.6c5.9,3.7,10,8.2,12.2,13.3c2.3,5.1,3.4,10.1,3.4,15 c0,4.8-1.2,9.7-3.5,14.7c-2.3,5-6.4,9.2-12.2,12.8c-5.8,3.6-13.7,5.4-23.7,5.4h-30.2v30.5H466z M522,44.6c9,0,13.6-3.3,13.6-9.9 c0-6.9-4.6-10.3-13.7-10.3h-30.1v20.2H522z M593,98.4h-25.8V1.2H593v38h43.9v-38h25.8v97.2h-25.8V59.9H593V98.4z M668.6,98.4V1.2h56c9.9,0,17.8,1.9,23.7,5.6c5.9,3.7,10,8.2,12.2,13.3c2.3,5.1,3.4,10.1,3.4,15 c0,4.8-1.2,9.7-3.5,14.7c-2.3,5-6.4,9.2-12.2,12.8c-5.8,3.6-13.7,5.4-23.7,5.4h-30.2v30.5H668.6z M724.6,44.6c9,0,13.6-3.3,13.6-9.9 c0-6.9-4.6-10.3-13.7-10.3h-30.1v20.2H724.6z M291.1,20.2h-33.5V0h33.5V20.2z"></path>
        </svg>
        <!-- Sidebar Content -->
        <nav class="relative mt-6 flex flex-col justify-between h-full space-y-6"
             x-data="{ openSystem: false, openDialog: false, openLaravel: false }">

            <div class="space-y-2">
                <!-- System -->
                <button
                    @click="openSystem = !openSystem"
                    type="button"
                    class="flex w-full items-center justify-between px-3 py-2 text-sm font-semibold dark:text-white">
                    <span>System</span>
                    <svg class="h-4 w-4 transform transition-transform" :class="openSystem ? 'rotate-180' : ''"
                         viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
                <div x-show="openSystem" x-transition>
                    <x-nav.link route="system.camera" icon="camera">Camera</x-nav.link>
                    <x-nav.link route="system.flashlight" icon="light-bulb">Flashlight</x-nav.link>
                    <x-nav.link route="system.push-notifications" icon="bell">Push Notifications</x-nav.link>
                    <x-nav.link route="system.vibrate" icon="fire">Vibrate</x-nav.link>
                    <x-nav.link route="system.biometric-scanner" icon="finger-print">Biometric Scanner</x-nav.link>
                </div>

                <!-- Dialog -->
                <button
                    @click="openDialog = !openDialog"
                    type="button"
                    class="flex w-full items-center justify-between px-3 py-2 text-sm font-semibold dark:text-white">
                    <span>Dialog</span>
                    <svg class="h-4 w-4 transform transition-transform" :class="openDialog ? 'rotate-180' : ''"
                         viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
                <div x-show="openDialog" x-transition>
                    <x-nav.link route="dialog.share" icon="share">Share</x-nav.link>
                    <x-nav.link route="dialog.alert" icon="bell-alert">Alert</x-nav.link>
                    <x-nav.link route="dialog.toast" icon="bolt">Toast</x-nav.link>
                </div>

                <!-- Laravel -->
                <button
                    @click="openLaravel = !openLaravel"
                    type="button"
                    class="flex w-full items-center justify-between px-3 py-2 text-sm font-semibold dark:text-white">
                    <span>Laravel</span>
                    <svg class="h-4 w-4 transform transition-transform" :class="openLaravel ? 'rotate-180' : ''"
                         viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
                <div x-show="openLaravel" x-transition>
                    <x-nav.link route="laravel.reverb" icon="chat-bubble-left-right">Reverb</x-nav.link>
                </div>
            </div>

            <!-- Sticky Bottom Links -->
            <div class="space-y-2 border-t border-indigo-500 pt-4">
                <x-nav.link href="https://nativephp.com/docs/mobile/1/getting-started/introduction"
                            icon="book-open">Docs
                </x-nav.link>
                <x-nav.link href="https://nativephp.com/mobile" icon="information-circle">Learn More</x-nav.link>
                <p class="text-xs text-center text-gray-300">v{{config('nativephp.version')}}</p>
            </div>
        </nav>


    </div>

    <!-- Main content -->
    <main class="pt-6 px-4">
        {{$slot}}
    </main>
</div>
@vite(['resources/js/app.js'])
</body>
</html>
