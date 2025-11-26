<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-red-500 to-pink-500 dark:from-red-600 dark:to-pink-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Video Recorder
                    </h1>
                    <p class="text-lg text-white">
                        Configure your settings and capture stunning videos with your device camera!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Settings Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <div class="space-y-2">
                <flux:label class="text-base font-semibold">Max Duration (seconds)</flux:label>
                <flux:input type="number" wire:model.live="maxDuration" placeholder="Leave empty for no limit" />
                <p class="text-sm text-muted-foreground">
                    Optional: Set a maximum recording duration in seconds. Use your camera app's built-in controls for quality and camera selection.
                </p>
            </div>
        </flux:card>

        <!-- Record Button Card -->
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-red-200 dark:border-red-800">
            <flux:button
                wire:click="recordVideo"
                icon="video-camera"
                class="py-6 w-full bg-gradient-to-br from-pink-500 to-rose-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Start Recording
            </flux:button>
        </flux:card>

        <!-- Now Playing Card -->
        @if($currentlyPlayingPath)
            <flux:card class="bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 border-2 border-indigo-200 dark:border-indigo-700">
                <div class="space-y-4">
                    <div>
                        <flux:heading size="lg" class="text-indigo-900 dark:text-indigo-100 flex items-center">
                            <flux:icon.play class="mr-2 size-6"/>
                            Now Playing
                        </flux:heading>
                        <flux:subheading class="text-indigo-700 dark:text-indigo-300">{{ basename($currentlyPlayingPath) }}</flux:subheading>
                    </div>

                    <video
                        src="{{ Storage::url($currentlyPlayingPath) }}"
                        poster="{{ asset('splash.png') }}"
                        controls
                        class="rounded-lg shadow-2xl w-full h-auto border-2 border-white/50"
                    >
                        Your browser does not support the video tag.
                    </video>

                    <div class="flex gap-2 justify-end">
                        <flux:button
                            wire:click="shareVideo('{{ $currentlyPlayingPath }}')"
                            icon="share"
                            class="bg-gradient-to-r from-blue-500 to-cyan-500 !text-white border-0 [&>span]:!text-white"
                        >
                            Share
                        </flux:button>
                        <flux:button variant="outline" wire:click="$set('currentlyPlayingPath', '')">
                            Close
                        </flux:button>
                    </div>
                </div>
            </flux:card>
        @endif

        <!-- Videos List Card -->
        @if($this->videos->isNotEmpty())
            <flux:card class="bg-gradient-to-br from-teal-100 to-cyan-100 dark:from-teal-900/30 dark:to-cyan-900/30 border-2 border-teal-200 dark:border-teal-700">
                <flux:heading size="lg" icon="video-camera" class="text-teal-900 dark:text-teal-100 mb-4">
                    My Videos ({{ $this->videos->count() }})
                </flux:heading>

                <div class="space-y-3">
                    @foreach($this->videos as $video)
                        <livewire:media-card :media="$video" type="video" :key="$video['path']"/>
                    @endforeach
                </div>
            </flux:card>
        @endif

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
    </div>
    <div class="pb-32"></div>
</div>

