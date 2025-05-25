<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.camera variant="mini" class="mr-2"/>
            Lights, Camera, Action!
        </flux:heading>

        <flux:subheading >
            <p>Press the button below to request permission to use the camera, press again to take a photo.</p>
        </flux:subheading>
    </flux:card>
    <flux:button variant="filled" icon="camera" wire:click="camera" class="w-full"> Take a Photo</flux:button>

    @if ($photoDataUrl)
        <img src="{{ $photoDataUrl }}" class="rounded-xl shadow max-w-sm w-full h-auto mt-12 mx-auto" />
    @endif
</div>

