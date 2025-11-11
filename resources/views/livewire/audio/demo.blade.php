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
                <div class="text-4xl font-mono font-bold" @if($this->audioStatus === 'recording') wire:poll.100ms @endif>
                    {{ $this->recordingDuration }}
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    @if($this->audioStatus === 'recording')
                        <span class="inline-flex items-center">
                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></span>
                            Recording
                        </span>
                    @elseif($this->audioStatus === 'paused')
                        <span>Paused</span>
                    @else
                        <span>Ready to record</span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <flux:button
                    wire:click="recordAudio"
                    variant="filled"
                    icon="microphone"
                    class="w-full"
                    :disabled="$this->audioStatus !== 'idle'"
                >
                    Record
                </flux:button>

                <flux:button
                    wire:click="{{ $this->audioStatus === 'paused' ? 'resumeAudio' : 'pauseAudio' }}"
                    variant="outline"
                    icon="pause"
                    class="w-full"
                    :disabled="$this->audioStatus === 'idle'"
                >
                    {{ $this->audioStatus === 'paused' ? 'Resume' : 'Pause' }}
                </flux:button>

                <flux:button
                    wire:click="stopAudio"
                    variant="danger"
                    icon="stop"
                    class="w-full"
                >
                    Stop
                </flux:button>
            </div>
        </div>
    </flux:card>
    @if($recording)
        <flux:card>
            <flux:subheading class="mb-4">Current Recording:</flux:subheading>
            <audio src="{{ asset($recording) }}" controls class="w-full mb-4"/>
        </flux:card>
    @endif
</div>
