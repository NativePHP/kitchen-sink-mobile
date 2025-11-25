<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-orange-500 to-amber-500 dark:from-orange-600 dark:to-amber-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Microphone
                    </h1>
                    <p class="text-lg text-white">
                        Record crystal-clear audio with professional controls at your fingertips! It even works while your device is locked!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Main Recording Card -->
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-orange-200 dark:border-orange-800">
            <div class="space-y-4">
                <!-- Status Display -->
                <div class="flex items-center justify-center py-8">
                    @if($this->audioStatus === 'recording')
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <div class="size-5 animate-pulse rounded-full bg-red-500 shadow-lg shadow-red-500/50"></div>
                                <div class="absolute inset-0 size-5 animate-ping rounded-full bg-red-500"></div>
                            </div>
                            <span class="text-4xl font-black bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">ON AIR</span>
                        </div>
                    @elseif($this->audioStatus === 'paused')
                        <div class="flex items-center gap-3">
                            <div class="size-5 rounded-full bg-yellow-500 shadow-lg shadow-yellow-500/50"></div>
                            <span class="text-4xl font-black bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent">PAUSED</span>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <div class="size-5 rounded-full bg-gray-400 shadow-lg"></div>
                            <span class="text-4xl font-black text-gray-500 dark:text-gray-400">READY</span>
                        </div>
                    @endif
                </div>

                <!-- Control Buttons -->
                <div class="grid grid-cols-2 gap-3">
                    @if($this->audioStatus === 'idle')
                        <flux:button
                            wire:click="recordAudio"
                            icon="microphone"
                            class="col-span-2 py-6 bg-gradient-to-br from-red-500 to-pink-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
                        >
                            Record
                        </flux:button>
                    @endif

                    @if($this->audioStatus === 'recording')
                        <flux:button
                            wire:click="pauseAudio"
                            icon="pause"
                            class="w-full py-6 bg-gradient-to-br from-yellow-500 to-orange-500 !text-white border-0 shadow-lg transition-all [&>span]:!text-white"
                        >
                            Pause
                        </flux:button>
                    @endif

                    @if($this->audioStatus === 'paused')
                        <flux:button
                            wire:click="resumeAudio"
                            icon="play"
                            class="w-full py-6 bg-gradient-to-br from-green-500 to-emerald-500 !text-white border-0 shadow-lg transition-all [&>span]:!text-white"
                        >
                            Resume
                        </flux:button>
                    @endif

                    @if($this->audioStatus !== 'idle')
                        <flux:button
                            wire:click="stopAudio"
                            icon="stop"
                            class="w-full py-6 bg-gradient-to-br from-red-600 to-rose-600 !text-white border-0 shadow-lg transition-all [&>span]:!text-white"
                        >
                            Stop
                        </flux:button>
                    @endif
                </div>
            </div>
        </flux:card>

        @if($currentlyPlayingPath)
            <flux:card class="bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 border-2 border-indigo-200 dark:border-indigo-700">
                <div class="space-y-4">
                    <flux:heading size="lg" icon="play" class="text-indigo-900 dark:text-indigo-100">Now Playing</flux:heading>
                    <flux:subheading class="text-indigo-700 dark:text-indigo-300">{{ basename($currentlyPlayingPath) }}</flux:subheading>

                    <audio
                        data-title="{{ config('app.name') }}"
                        data-artist="{{ now() }}"
                        src="{{ Storage::disk('public')->url($currentlyPlayingPath) }}"
                        controls
                        class="w-full flex-1"
                    >
                        Your browser does not support the audio tag.
                    </audio>

                    <div class="flex gap-2 justify-end">
                        <flux:button variant="ghost" wire:click="$set('currentlyPlayingPath', '')">Close</flux:button>
                    </div>
                </div>
            </flux:card>
        @endif

        @if($this->audioFiles->isNotEmpty())
            <flux:card class="bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 border-2 border-purple-200 dark:border-purple-700">
                <flux:heading size="lg" icon="play" class="text-purple-900 dark:text-purple-100 mb-4">My Recordings ({{ $this->audioFiles->count() }})</flux:heading>

                <div class="grid grid-cols-1 gap-3">
                    @foreach($this->audioFiles as $audio)
                        <livewire:media-card :media="$audio" type="audio" :key="$audio['path']" />
                    @endforeach
                </div>
            </flux:card>
        @endif
        <div class="pb-32"></div>
    </div>
</div>
