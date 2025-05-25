<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.bolt variant="mini" class="mr-2"/>
            Toasty!
        </flux:heading>

        <flux:subheading >
            <p>Enter some text and press the button below to show a custom toast dialog.</p>
        </flux:subheading>
    </flux:card>
    <flux:card class="space-y-6">
        <div class="space-y-6">
            <flux:input wire:model="message" label="Message"  placeholder="Type a message" />
        </div>

        <div class="space-y-2">
            <flux:button icon="bolt" variant="filled" class="w-full" wire:click="toast">Show Toast</flux:button>
        </div>
    </flux:card>
</div>
