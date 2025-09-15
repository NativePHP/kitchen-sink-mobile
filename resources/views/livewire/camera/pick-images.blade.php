<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.image-plus variant="mini" class="mr-2"/>
            Gallery!
        </flux:heading>

        <flux:subheading >
            <p>Press the button below to open the gallery.</p>
        </flux:subheading>
    </flux:card>
    <flux:button variant="filled" icon="image-plus" wire:click="gallery('image')" class="w-full">Select Single Image</flux:button>
    <flux:button variant="filled" icon="images" wire:click="gallery('image', true, 5)" class="w-full">Select Multiple Images</flux:button>
    @if (count($photos))
        @foreach($photos as $photo)
            <img src="{{ $photo }}" class="rounded-xl shadow max-w-sm w-full h-auto mt-12 mx-auto" />
        @endforeach
    @endif

    @if (count($videos))
        @foreach($videos as $video)
            <video controls class="rounded-xl shadow max-w-sm w-full h-auto mt-12 mx-auto">
                <source src="{{ $video }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endforeach
    @endif
</div>
