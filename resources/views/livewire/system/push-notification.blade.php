<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.bell variant="mini" class="mr-2"/>
            Push Notifications!
        </flux:heading>

        <flux:subheading >
            <p>Press the button below to request permission to send push notifications.</p>
        </flux:subheading>
    </flux:card>
    <flux:button variant="filled" icon="bell" wire:click="promptForPushNotifications" class="w-full"> Request Push Notifications</flux:button>
</div>
