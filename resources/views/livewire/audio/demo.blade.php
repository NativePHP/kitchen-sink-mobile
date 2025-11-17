<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.speaker-wave variant="mini" class="mr-2"/>
            Audio Demo
        </flux:heading>

        <flux:subheading>
            <p>Audio API integration demo.</p>
        </flux:subheading>
    </flux:card>

    <flux:card>
        <div class="space-y-4">
            <div class="text-center">
                <div class="text-4xl font-mono font-bold"
                     @if($this->audioStatus === 'recording') wire:poll.1000ms @endif>
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    @if($this->audioStatus === 'recording')
                        <div>
                            <p class="text-4xl font-black text-red-600 animate-pulse" style="text-shadow:#FF2D95 0px 0px 20px, #FF2D95 0px 0px 30px, #FF2D95 0px 0px 40px">ON-AIR</p>
                        </div>
                    @elseif($this->audioStatus === 'paused')
                        <div>
                            <p class="text-4xl font-black text-gray-800 dark:text-white" >PAUSED</p>
                        </div>
                    @else
                        <div>
                            <p class="text-4xl font-black text-gray-800 dark:text-white" >READY</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-center gap-4">
                @if($this->audioStatus === 'idle')
                <button wire:click="recordAudio" :disabled="$this->audioStatus !== 'idle'" class="bg-red-500 text-white flex items-center justify-center p-6 py-2 rounded-lg">
                    <flux:icon.microphone class="size-10"></flux:icon.microphone>
                </button>
                @endif
                @if($this->audioStatus !== 'idle')
                    <button wire:click="{{ $this->audioStatus === 'paused' ? 'resumeAudio' : 'pauseAudio' }}" class="bg-gray-500 dark:bg-cyan-400 text-white flex items-center justify-center p-6 py-2 rounded-lg">
                        <flux:icon.pause class="size-10"></flux:icon.pause>
                    </button>
                    <button wire:click="stopAudio" class="bg-gray-500 dark:bg-red-600 text-white flex items-center justify-center p-6 py-2 rounded-lg">
                        <flux:icon.stop class="size-10"></flux:icon.stop>
                    </button>
                @endif
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
        <flux:card>
            <flux:heading size="lg" class="mb-4">My Recordings ({{ $this->audioFiles->count() }})</flux:heading>

            <div class="grid grid-cols-1 gap-3">
                @foreach($this->audioFiles as $audio)
                    <livewire:media-card :media="$audio" type="audio" :key="$audio['path']" />
                @endforeach
            </div>
        </flux:card>
    @endif
</div>
