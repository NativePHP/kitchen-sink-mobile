<div class="space-y-6">
    <x-layouts.app.callout title="Lights, Camera, Action!" icon="camera">
        Press the button below to request permission to use the camera, press again to take a photo.
    </x-layouts.app.callout>

    <x-layouts.app.button title="Take a Photo" icon="camera" wire:click="camera"/>


    @if ($photoDataUrl)
        <img src="{{ $photoDataUrl }}" class="rounded shadow max-w-sm w-full h-auto mt-12 mx-auto" />
    @endif
</div>
