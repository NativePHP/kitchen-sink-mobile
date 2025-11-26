<div
    class="space-y-4 bg-white  min-h-screen">
    <div
        class="bg-gradient-to-br from-teal-500 to-purple-600 text-white pt-[var(--inset-top)] rounded-none border-none ">
        <div class="px-4">
            <div class="space-y-3">
                <h1 size="xl" class="text-white text-3xl pt-2 font-black flex items-center">
                    NativePHP v2
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2" width="1em" height="1em" viewBox="0 0 128 128"><defs><path id="SVGva4FLcjy" fill="#fb70a9" d="M108.566 83.547c-1.937 2.926-3.406 6.527-7.34 6.527c-6.624 0-6.98-10.203-13.609-10.203c-6.625 0-6.265 10.203-12.887 10.203c-6.625 0-6.98-10.203-13.609-10.203c-6.625 0-6.266 10.203-12.887 10.203c-6.625 0-6.98-10.203-13.605-10.203c-6.629 0-6.27 10.203-12.89 10.203c-2.083 0-3.544-1.008-4.778-2.39c-4.738-8.239-7.465-17.895-7.465-28.22c0-30.222 23.367-54.722 52.191-54.722s52.192 24.5 52.192 54.723c0 8.64-1.91 16.816-5.313 24.082m0 0"/></defs><use href="#SVGva4FLcjy" fill-rule="evenodd"/><path fill="#4e56a6" fill-rule="evenodd" d="M40.844 78.145v22.668c0 4.066-3.301 7.363-7.371 7.363a7.365 7.365 0 0 1-7.371-7.364V73.45c1.375-2.523 2.945-4.707 5.78-4.707c4.61 0 6.223 5.79 8.962 9.403Zm27.843 1.183v35.844a8.185 8.185 0 0 1-8.187 8.183c-4.523 0-8.191-3.664-8.191-8.183v-40.57c1.543-2.973 3.132-5.86 6.39-5.86c5.16 0 6.563 7.242 9.989 10.586Zm26.211-.66v26.023c0 4.067-3.3 7.364-7.37 7.364s-7.372-3.297-7.372-7.364V72.707c1.281-2.195 2.809-3.965 5.364-3.965c4.84 0 6.375 6.38 9.378 9.926m0 0"/><path fill-opacity=".298" fill-rule="evenodd" d="M40.844 85.094c-1.309-1.602-2.856-2.79-5.094-2.79c-5.316 0-6.293 6.696-9.648 9.712V63.145a7.365 7.365 0 0 1 7.37-7.364c4.071 0 7.372 3.297 7.372 7.364Zm27.843.515c-1.394-1.855-3.023-3.304-5.496-3.304c-5.914 0-6.457 8.285-10.882 10.578v-12.77c0-4.52 3.668-8.183 8.191-8.183a8.185 8.185 0 0 1 8.188 8.183Zm26.211-1.433c-1.136-1.117-2.48-1.871-4.265-1.871c-5.73 0-6.418 7.777-10.477 10.343V66.734a7.371 7.371 0 0 1 14.742 0Zm0 0"/><use href="#SVGva4FLcjy" fill-rule="evenodd"/><path fill="#e24ca6" fill-rule="evenodd" d="M97.273 88.984c13.676-20.332 14.028-42.879 1.059-67.652c9.613 9.844 15.547 23.348 15.547 38.25c0 8.61-1.98 16.75-5.508 23.992c-2.004 2.91-3.531 6.5-7.61 6.5a5.95 5.95 0 0 1-3.488-1.09m0 0"/><path fill="#fff" fill-rule="evenodd" d="M58.89 73.117c18.15 0 25.79-10.52 25.79-25.46c0-14.942-11.547-28.692-25.79-28.692c-14.245 0-25.792 13.75-25.792 28.691c0 14.942 7.64 25.461 25.793 25.461Zm0 0"/><path fill="#030776" fill-rule="evenodd" d="M61.625 37.836c0 5.89-4.332 10.668-9.672 10.668c-5.344 0-9.672-4.777-9.672-10.668s4.328-10.668 9.672-10.668c5.34 0 9.672 4.777 9.672 10.668m0 0"/><path fill="#fff" fill-rule="evenodd" d="M55.176 35.375c0 2.719-2.164 4.922-4.836 4.922s-4.836-2.203-4.836-4.922s2.164-4.922 4.836-4.922s4.836 2.203 4.836 4.922m0 0"/></svg>
                </h1>
                <flux:subheading class="text-white text-xl pb-4">
                    Explore the full power of native mobile capabilities built with Laravel and PHP.
                </flux:subheading>
            </div>
        </div>
    </div>

    <div class="px-4 relative w-full">
        <div class="space-y-1 ">
            <div class="absolute top-0 right-0 -mt-5">
                <flux:icon.light-bulb class="size-40 text-yellow-400/10"/>
            </div>
            <p class="font-bold text-xl text-black ">
                E.D.G.E
            </p>
            <p class="text-base text-black leading-relaxed ">
                Introducing Element Definition and Generation Engine, NativePHP's innovative rendering engine that transforms Blade components into native UI elements.
            </p>
        </div>
        <div class="space-y-4">
            <div
                x-data
                x-init="
                    setInterval(() => {
                        if ($el.scrollLeft >= $el.scrollWidth - $el.clientWidth) {
                            $el.scrollLeft = 0;
                        } else {
                            $el.scrollLeft += 1;
                        }
                    }, 50);
                "
                class="flex gap-3 overflow-x-auto pb-4 scrollbar-hide -mr-4 pl-0 pr-4 my-10">
                @foreach($featuredDemos as $demo)
                    <a href="{{route($demo['route'])}}" wire:key="demo-{{ $loop->index }}" class="snap-start shrink-0">
                        <flux:card
                            class="bg-gradient-to-br {{ $demo['gradient'] }} hover:shadow-lg transition-shadow cursor-pointer size-40 rounded-lg">
                            <div class="flex flex-col items-center justify-center text-center gap-1.5 h-full p-2">
                                <div
                                    class="size-16 rounded-full bg-white/30 flex items-center justify-center">
                                    <flux:icon icon="{{$demo['icon']}}" class="size-12 text-white"/>
                                </div>
                                <div>
                                    <h1 class="text-sm font-bold text-white leading-tight">{{ $demo['title'] }}</h1>
                                </div>
                            </div>
                        </flux:card>
                    </a>
                @endforeach
            </div>

            <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
        </div>
    </div>
    <div class="pb-32"></div>
</div>
