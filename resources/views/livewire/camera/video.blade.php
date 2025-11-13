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
            <flux:input type="number" wire:model.live="maxDuration" placeholder="Leave empty for no limit" />
            <flux:description>Optional: Set a maximum recording duration in seconds. Use your camera app's built-in controls for quality and camera selection.</flux:description>
        </flux:field>
    </flux:card>

    <flux:button variant="filled" icon="video-camera" wire:click="recordVideo" class="w-full">
        Record Video
    </flux:button>

    <flux:modal name="video-modal" wire:model="showVideoModal" class="max-w-4xl">
        <flux:modal.trigger>
            <!-- Modal is controlled programmatically -->
        </flux:modal.trigger>

        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Recorded Video</flux:heading>
                <flux:subheading>Your video has been recorded successfully!</flux:subheading>
            </div>

            <video src="{{ $videoUrl }}" poster="{{ asset('splash.png') }}" controls class="rounded-lg shadow-lg w-full h-auto">
                Your browser does not support the video tag.
            </video>

            <div class="flex gap-2 justify-end">
                <flux:button variant="ghost" wire:click="share" icon="share"></flux:button>
                <flux:button variant="ghost" wire:click="$set('showVideoModal', false)">Close</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

