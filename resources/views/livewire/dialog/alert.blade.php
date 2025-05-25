<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.bell-alert variant="mini" class="mr-2"/>
            Alert
        </flux:heading>

        <flux:subheading >
            <p>Press the button below to show an alert dialog.</p>
        </flux:subheading>
    </flux:card>
    <flux:button variant="filled" icon="bell-alert" wire:click="alert" class="w-full">Alert</flux:button>
</div>
