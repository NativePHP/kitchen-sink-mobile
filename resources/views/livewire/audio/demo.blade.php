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
            <div class="flex items-center justify-between">
                <audio data-title="{{config('app.name')}}"
                       data-artist="{{now()}}"
                       src="{{ asset($recording) }}" controls></audio>
                <flux:button wire:click="share" icon="share" variant="ghost"></flux:button>
            </div>
        </flux:card>
    @endif
</div>
