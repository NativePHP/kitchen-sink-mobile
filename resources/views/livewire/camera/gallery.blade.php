<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-purple-500 to-violet-500 dark:from-purple-600 dark:to-violet-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Gallery
                    </h1>
                    <p class="text-lg text-white">
                        Browse and select amazing photos and videos from your device gallery!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Single Image Button Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <flux:button
                wire:click="gallery('image')"
                icon="photo"
                class="py-6 w-full bg-gradient-to-br from-purple-500 to-violet-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Select Single Image
            </flux:button>
        </flux:card>

        <!-- Multiple Images Button Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <flux:button
                wire:click="gallery('image', true, 5)"
                icon="photo"
                class="py-6 w-full bg-gradient-to-br from-violet-500 to-purple-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Select Multiple Images
            </flux:button>
        </flux:card>

        @if (count($photos))
            <flux:card class="bg-gradient-to-br from-purple-100 to-violet-100 dark:from-purple-900/30 dark:to-violet-900/30 border-2 border-purple-200 dark:border-purple-700">
                <flux:heading icon="photo" class="text-purple-900 dark:text-purple-100 mb-4">
                    Selected Images ({{ count($photos) }})
                </flux:heading>
                @foreach($photos as $photo)
                    <img src="{{ $photo }}" class="rounded-xl shadow-xl border-2 border-white/50 max-w-sm w-full h-auto mt-4 mx-auto" />
                @endforeach
            </flux:card>
        @endif

        @if (count($videos))
            <flux:card class="bg-gradient-to-br from-pink-100 to-fuchsia-100 dark:from-pink-900/30 dark:to-fuchsia-900/30 border-2 border-pink-200 dark:border-pink-700">
                <flux:heading icon="video-camera" class="text-pink-900 dark:text-pink-100 mb-4">
                    Selected Videos ({{ count($videos) }})
                </flux:heading>
                @foreach($videos as $video)
                    <video controls class="rounded-xl shadow-xl border-2 border-white/50 max-w-sm w-full h-auto mt-4 mx-auto">
                        <source src="{{ $video }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endforeach
            </flux:card>
        @endif

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
    </div>
    <div class="pb-32"></div>
</div>
