<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.globe-alt variant="mini" class="mr-2"/>
            Network!
        </flux:heading>

        <flux:subheading>
            <p>Press the button below to toggle view your current network status.</p>
        </flux:subheading>
    </flux:card>
    <flux:button variant="filled" icon="globe-alt" wire:click="getNetwork" class="w-full">Get Network</flux:button>
    @if($connected)
        <flux:callout icon="sparkles" color="purple">
            <flux:callout.heading>You are connected!</flux:callout.heading>

            <flux:callout.text>
                Looks like you are connected via: {{str($status)->upper()}} fancy pants!
            </flux:callout.text>
        </flux:callout>
    @else
        <flux:callout icon="exclamation-triangle" color="red">
            <flux:callout.heading>Looks like you are {{str($status)->upper()}}</flux:callout.heading>
        </flux:callout>
    @endif
</div>
