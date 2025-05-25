<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.light-bulb variant="mini" class="mr-2"/>
            Flashlight!
        </flux:heading>

        <flux:subheading >
            <p>Press the button below to toggle the flashlight.</p>
        </flux:subheading>
    </flux:card>
    <flux:button variant="filled" icon="light-bulb" wire:click="flashlight" class="w-full">Toggle Flashlight</flux:button>
</div>
