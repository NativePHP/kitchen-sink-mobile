<div>
    <flux:callout >
        <flux:callout.heading icon="camera">Lights, Camera, Action!</flux:callout.heading>

        <flux:callout.text>
            Press the button below to request permission to use the camera, press again to take a photo.

        </flux:callout.text>
    </flux:callout>

    <flux:button wire:click="camera" icon="camera" class="w-full mt-12">Take a Photo</flux:button>
    @if ($photoDataUrl)
        <img src="{{ $photoDataUrl }}" class="rounded shadow max-w-sm size-64 mt-12 mx-auto" />
    @endif
</div>
