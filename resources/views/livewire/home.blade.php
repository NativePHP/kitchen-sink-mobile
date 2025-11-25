<div class="space-y-4 bg-white">
    <div
        class="bg-gradient-to-br from-teal-500 to-purple-600 text-white pt-[var(--inset-top)] rounded-none border-none ">
        <div class="flex items-start gap-4 px-6">
            <div class="space-y-3">
                <flux:heading size="xl" class="text-white text-3xl pt-2 font-semibold">
                    NativePHP v2
                </flux:heading>
                <flux:subheading class="text-white text-xl pb-4">
                    Explore the full power of native mobile capabilities built with Laravel and PHP. This kitchen sink
                    app demonstrates every feature available in the NativePHP Mobile ecosystem.
                </flux:subheading>
            </div>
        </div>
    </div>

    <div class="px-4">
        <div class="bg-zinc-50">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <span
                        class="text-3xl font-black bg-gradient-to-b from-red-800 to-red-500 text-transparent bg-clip-text inline-block">The Blade's EDGE 🔥</span>
                </div>

                <flux:subheading size="xl" class="font-semibold text-zinc-900 ">
                    Element Definition and Generation Engine
                </flux:subheading>

                <p class="text-base text-zinc-600 leading-relaxed">
                    The top bar, side navigation, and bottom navigation in this app are powered by EDGE, NativePHP's
                    innovative rendering engine that transforms Blade components into native UI elements. Write familiar
                    Laravel Blade templates and watch them render as true native iOS and Android components.
                </p>
            </div>
        </div>

        <div class="space-y-4 mt-4">
            <div class="grid grid-cols-2 gap-3">
                @foreach($featuredDemos as $demo)
                    <a href="{{route($demo['route'])}}" wire:key="demo-{{ $loop->index }}">
                        <flux:card
                            class="bg-gradient-to-br {{ $demo['gradient'] }} hover:shadow-lg transition-shadow cursor-pointer">
                            <div class="flex flex-col items-center text-center gap-3 p-3">
                                <div
                                    class="size-10 rounded-full bg-white/30 flex items-center justify-center">
                                    <flux:icon icon="{{$demo['icon']}}" class="size-6 text-white"/>
                                </div>
                                <div>
                                    <flux:heading class="text-xl text-white">{{ $demo['title'] }}</flux:heading>
                                </div>
                            </div>
                        </flux:card>
                    </a>
                @endforeach
            </div>
        </div>

        <flux:card class="bg-zinc-50 mt-4">
            <div class="flex items-start gap-3">
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <p class="text-xl font-medium text-zinc-900 ">Get Started</p>
                        <flux:icon.information-circle
                            class="size-5 text-blue-600 mt-0.5 flex-shrink-0"/>
                    </div>
                    <p class="text-base text-zinc-600 leading-relaxed">Explore the side menu to
                        discover
                        all features, or tap any card above to jump right in. Each demo includes interactive examples
                        showing real native mobile capabilities.</p>
                </div>
            </div>
        </flux:card>
    </div>
    <div class="pb-32"></div>
</div>
