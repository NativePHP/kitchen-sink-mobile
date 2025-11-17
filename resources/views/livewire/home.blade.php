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

    <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <span  class="text-3xl font-black bg-gradient-to-b from-red-800 to-red-500 text-transparent bg-clip-text inline-block">The Blade's EDGE 🔥</span>
            </div>

            <flux:subheading size="xl" class="font-semibold text-zinc-900 dark:text-zinc-100">
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
                <flux:card class="bg-gradient-to-br from-blue-300 to-cyan-300 dark:from-blue-400 dark:to-cyan-400 hover:shadow-lg transition-shadow cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-3 p-3">
                        <div
                            class="size-18 rounded-full bg-white/30 dark:bg-white/20 flex items-center justify-center">
                            <flux:icon.qr-code class="size-12 text-white"/>
                        </div>
                        <div>
                            <flux:heading class="text-xl text-white">Scanner</flux:heading>
                        </div>
                    </div>
                </flux:card>
            </a>

            <a href="{{route('network.demo')}}">
                <flux:card class="bg-gradient-to-br from-green-300 to-emerald-300 dark:from-green-400 dark:to-emerald-400 hover:shadow-lg transition-shadow cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-3 p-3">
                        <div
                            class="size-18 rounded-full bg-white/30 dark:bg-white/20 flex items-center justify-center">
                            <flux:icon.globe-alt class="size-12 text-white"/>
                        </div>
                        <div>
                            <flux:heading class="text-white text-xl">Network</flux:heading>
                        </div>
                    </div>
                </flux:card>
            </a>

            <a href="{{route('audio.demo')}}">
                <flux:card class="bg-gradient-to-br from-purple-300 to-violet-300 dark:from-purple-400 dark:to-violet-400 hover:shadow-lg transition-shadow cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-3 p-3">
                        <div
                            class="size-18 rounded-full bg-white/30 dark:bg-white/20 flex items-center justify-center">
                            <flux:icon.speaker-wave class="size-12 text-white"/>
                        </div>
                        <div>
                            <flux:heading class="text-xl text-white">Audio</flux:heading>
                        </div>
                    </div>
                </flux:card>
            </a>

            <a href="{{route('camera.video')}}">
                <flux:card class="bg-gradient-to-br from-red-300 to-pink-300 dark:from-red-400 dark:to-pink-400 hover:shadow-lg transition-shadow cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-3 p-3">
                        <div
                            class="size-18 rounded-full bg-white/30 dark:bg-white/20 flex items-center justify-center">
                            <flux:icon.video-camera class="size-12 text-white"/>
                        </div>
                        <div>
                            <flux:heading class="text-xl text-white">Video</flux:heading>
                        </div>
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
