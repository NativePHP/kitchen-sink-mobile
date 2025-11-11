<div class="space-y-4 mt-2">
    <flux:card class="bg-gradient-to-br from-purple-500 to-pink-500 dark:from-purple-600 dark:to-pink-600 text-white">
        <div class="flex items-start gap-4">
            <flux:icon.sparkles class="size-10 mt-1 flex-shrink-0"/>
            <div class="space-y-3">
                <flux:heading size="xl" class="text-white text-2xl">
                    NativePHP Mobile v2
                </flux:heading>
                <flux:subheading class="text-white/90 text-base">
                    Explore the full power of native mobile capabilities built with Laravel and PHP. This kitchen sink
                    app demonstrates every feature available in the NativePHP Mobile ecosystem.
                </flux:subheading>
            </div>
        </div>
    </flux:card>

    <flux:card class="border-2 border-blue-500/20 dark:border-blue-400/20">
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="size-12 rounded-lg bg-blue-500/10 dark:bg-blue-500/20 flex items-center justify-center">
                    <flux:icon.cube class="size-7 text-blue-600 dark:text-blue-400"/>
                </div>
                <flux:heading size="lg" class="text-xl">The Blade's EDGE</flux:heading>
            </div>

            <flux:subheading size="lg" class="font-semibold text-zinc-900 dark:text-zinc-100">
                Element Definition and Generation Engine
            </flux:subheading>

            <p class="text-base text-zinc-600 dark:text-zinc-400 leading-relaxed">
                The top bar, side navigation, and bottom navigation in this app are powered by EDGE, NativePHP's
                innovative rendering engine that transforms Blade components into native UI elements. Write familiar
                Laravel Blade templates and watch them render as true native iOS and Android components.
            </p>
        </div>
    </flux:card>

    <div class="space-y-4">
        <flux:heading size="lg" class="px-1 text-xl">Featured Demos</flux:heading>

        <div class="grid grid-cols-2 gap-3">
            <a href="{{route('scanner.demo')}}">
                <flux:card class="relative hover:shadow-lg transition-shadow cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-3 p-3">
                        <div
                            class="size-14 rounded-full bg-blue-500/10 dark:bg-blue-500/20 flex items-center justify-center">
                            <flux:icon.qr-code class="size-7 text-blue-600 dark:text-blue-400"/>
                        </div>
                        <div>
                            <flux:heading class="text-base">Scanner</flux:heading>
                        </div>
                        <flux:badge class="absolute top-0 right-0" icon="sparkles" color="blue">New</flux:badge>
                    </div>
                </flux:card>
            </a>

            <a href="{{route('network.demo')}}">
                <flux:card class="relative hover:shadow-lg transition-shadow cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-3 p-3">
                        <div
                            class="size-14 rounded-full bg-green-500/10 dark:bg-green-500/20 flex items-center justify-center">
                            <flux:icon.globe-alt class="size-7 text-green-600 dark:text-green-400"/>
                        </div>
                        <div>
                            <flux:heading>Network</flux:heading>
                        </div>
                        <flux:badge class="absolute top-0 right-0" icon="sparkles" color="green">New</flux:badge>
                    </div>
                </flux:card>
            </a>

            <a href="{{route('audio.demo')}}">
                <flux:card class="relative hover:shadow-lg transition-shadow cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-3 p-3">
                        <div
                            class="size-14 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                            <flux:icon.speaker-wave class="size-7 text-purple-600 dark:text-purple-400"/>
                        </div>
                        <div>
                            <flux:heading class="text-base">Audio</flux:heading>
                        </div>
                        <flux:badge class="absolute top-0 right-0" icon="sparkles" color="purple">New</flux:badge>
                    </div>
                </flux:card>
            </a>

            <a href="{{route('camera.video')}}">
                <flux:card class="relative hover:shadow-lg transition-shadow cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-3 p-3">
                        <div
                            class="size-14 rounded-full bg-red-500/10 dark:bg-red-500/20 flex items-center justify-center">
                            <flux:icon.video-camera class="size-7 text-red-600 dark:text-red-400"/>
                        </div>
                        <div>
                            <flux:heading class="text-base">Video</flux:heading>
                        </div>
                        <flux:badge class="absolute top-0 right-0" icon="sparkles" color="red">New</flux:badge>
                    </div>
                </flux:card>
            </a>
        </div>
    </div>

    <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
        <div class="flex items-start gap-3">
            <flux:icon.information-circle class="size-6 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0"/>
            <div class="space-y-2">
                <p class="text-base font-medium text-zinc-900 dark:text-zinc-100">Get Started</p>
                <p class="text-base text-zinc-600 dark:text-zinc-400 leading-relaxed">Explore the side menu to discover
                    all features, or tap any card above to jump right in. Each demo includes interactive examples
                    showing real native mobile capabilities.</p>
            </div>
        </div>
    </flux:card>
</div>
