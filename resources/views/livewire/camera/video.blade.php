<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.video-camera variant="mini" class="mr-2"/>
            Video Recorder
        </flux:heading>

        <flux:subheading>
            <p>Configure your video settings and press record to capture a video.</p>
        </flux:subheading>
    </flux:card>

    <flux:card>
        <flux:field>
            <flux:label>Max Duration (seconds)</flux:label>
            <flux:input type="number" wire:model.live="maxDuration" placeholder="Leave empty for no limit"/>
            <flux:description>Optional: Set a maximum recording duration in seconds. Use your camera app's built-in
                controls for quality and camera selection.
            </flux:description>
        </flux:field>
    </flux:card>

    <flux:card>
        <div class="text-center">
            <div class=" justify-center gap-4">
                <p class="text-4xl font-black text-gray-800 dark:text-white">READY</p>
                <div class="flex justify-center">
                    <button wire:click="recordVideo"
                            class="bg-red-500 text-white flex items-center justify-center p-6 py-2 rounded-lg mt-4">
                        <flux:icon.video-camera class="size-10"></flux:icon.video-camera>
                    </button>
                </div>
            </div>
        </div>
    </flux:card>

    @if($currentlyPlayingPath)
        <flux:card>
            <div class="space-y-4">
                <div>
                    <flux:heading size="lg">Now Playing</flux:heading>
                    <flux:subheading>{{ basename($currentlyPlayingPath) }}</flux:subheading>
                </div>

                <video
                    src="{{ Storage::disk('public')->url($currentlyPlayingPath) }}"
                    poster="{{ asset('splash.png') }}"
                    controls
                    class="rounded-lg shadow-lg w-full h-auto"
                >
                    Your browser does not support the video tag.
                </video>

                <div class="flex gap-2 justify-end">
                    <flux:button variant="ghost" icon="share" wire:click="shareVideo('{{ $currentlyPlayingPath }}')">
                        Share
                    </flux:button>
                    <flux:button variant="ghost" wire:click="$set('currentlyPlayingPath', '')">Close</flux:button>
                </div>
            </div>
        </flux:card>
    @endif

    @if($this->videos->isNotEmpty())
        <flux:card>
            <flux:heading size="lg" class="mb-4">My Videos ({{ $this->videos->count() }})</flux:heading>

            <div class="grid grid-cols-1 gap-3">
                @foreach($this->videos as $video)
                    <livewire:media-card :media="$video" type="video" :key="$video['path']"/>
                @endforeach
            </div>
        </flux:card>
    @endif
</div>

