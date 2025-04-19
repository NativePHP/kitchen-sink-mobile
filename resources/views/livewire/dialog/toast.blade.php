<div>
    <flux:callout >
        <flux:callout.heading icon="bolt">Toast!</flux:callout.heading>

        <flux:callout.text>
            Enter some text and press the button below to show a custom toast dialog.
        </flux:callout.text>
    </flux:callout>

    <flux:card class="space-y-6 mt-8">
        <flux:field>
            <flux:label>Toasty!</flux:label>
            <flux:input wire:model="message" type="text" />
            <flux:error name="toast" />
        </flux:field>

        <flux:button wire:click="toast" icon="bolt" class="w-full ">Show Toast</flux:button>
    </flux:card>
</div>
